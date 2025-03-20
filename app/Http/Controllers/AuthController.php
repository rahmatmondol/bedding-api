<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Categories;
use App\Models\Locations;
use App\Models\Profile;
use App\Helpers\CountryHelper;
use App\Notifications\ForgetPassword;
use App\Services\FirebaseAuthService;
use Carbon\Carbon;

class AuthController extends Controller
{

    private $firebaseAuth;

    public function __construct(FirebaseAuthService $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }


    /**
     * Register user with both Firebase and database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate request
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'country' => 'required|string|max:255',
                'mobile' => 'required|string|max:255|unique:users',
                'category_id' => 'required|integer',
                'account_type' => 'required|string|in:provider,customer',
                'last_name' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'language' => 'nullable|string|max:255',
                'image' => 'nullable|string'
            ]);
        } catch (ValidationException $e) {
            return ResponseHelper::error($e->errors(), 422);
        }

        // Start database transaction
        DB::beginTransaction();

        try {
            // 1. Create Firebase user
            // $firebaseUser = $this->firebaseAuth->signUp(
            //     $validated['email'],
            //     $validated['password']
            // );

            // 2. Create database user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'mobile' => $validated['mobile'],
            ]);

            // $user->firebase()->create([
            //     'firebase_uid' => $firebaseUser['localId'] ?? null,
            //     'firebase_token' => $firebaseUser['idToken'] ?? null,
            //     'firebase_refresh_token' => $firebaseUser['refreshToken'] ?? null
            // ]);

            // 3. Assign role
            $role = $validated['account_type'] === 'provider' ? 'provider' : 'customer';
            $user->assignRole($role);

            // 4. Create user profile
            $profile = $user->profile()->create([
                'country' => $validated['country'],
                'last_name' => $validated['last_name'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'language' => $validated['language'] ?? 'English',
                'image' => $validated['image'] ?? null,
            ]);

            // 5. Attach category to profile
            $profile->category()->associate($validated['category_id']);
            $profile->save();

            // If everything is successful, commit the transaction
            DB::commit();

            // Generate JWT token
            $token = JWTAuth::fromUser($user);

            $data = [
                'token' => $token,
                'user' => $user->load('profile', 'roles')
            ];

            return ResponseHelper::success('User registered successfully', $data);
        } catch (Exception $e) {
            // Rollback database changes if anything fails
            DB::rollBack();

            // If Firebase user was created but database failed, we should handle cleanup
            if (isset($firebaseUser['localId'])) {
                try {
                    // You would need to add a deleteUser method to your FirebaseAuthService
                    $this->firebaseAuth->deleteUser($firebaseUser['idToken']);
                } catch (Exception $deleteException) {
                    logger()->error('Failed to delete Firebase user after registration rollback: ' . $deleteException->getMessage());
                }
            }

            logger()->error('Registration error: ' . $e->getMessage());
            return ResponseHelper::error('Registration failed: ' . $e->getMessage(), 422);
        }
    }

    /**
     * Delete user method for cleanup in case of failure
     * Add this to your FirebaseAuthService class
     */
    public function deleteUser(string $idToken): array
    {
        try {
            $response = Http::post("{$this->baseUrl}/accounts:delete", [
                'key' => $this->apiKey,
                'idToken' => $idToken
            ]);

            if ($response->failed()) {
                throw new Exception($response['error']['message'] ?? 'Delete user failed');
            }

            return $response->json();
        } catch (Exception $e) {
            logger()->error('Firebase delete user error: ' . $e->getMessage());
            throw $e;
        }
    }



    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user = auth()->user()->load(['profile']);

        return response()->json(compact('token', 'user'));
    }

    // getCountry
    public function getCountry()
    {
        return response()->json(CountryHelper::getAllCountries());
    }

    // Set location
    public function updateProfile(Request $request)
    {

        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'string|max:255',
                'email' => 'email|unique:users,email,' . auth()->user()->id,
                'mobile' => 'string|unique:users,mobile,' . auth()->user()->id,
                'latitude' => 'string',
                'longitude' => 'string',
                'country' => 'string|max:255',
                'last_name' => 'string|max:255',
                'bio' => 'string',
                'language' => 'string|max:255',
            ]);

            // Check if the user is authenticated
            $user = auth()->user();

            if (!$user) {
                return ResponseHelper::error('User not authenticated', 401);
            }


            // Get the user's profile
            $user->load('profile');
            if (!$user->profile) {
                // Create a new profile for the user
                $profile = new Profile;
                $profile->location = $request->location ?? null;
                $profile->latitude = $request->latitude ?? null;
                $profile->longitude = $request->longitude ?? null;
                $profile->country = $request->country ?? null;
                $profile->last_name = $request->last_name ?? null;
                $profile->bio = $request->bio ?? null;
                $profile->language = $request->language ?? 'English';
                $profile->category_id = $request->category_id ?? null;
                $profile->save();

                // asing category to profile

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $originalName = $image->getClientOriginalName();
                    $filename = time() . '_' . $originalName;

                    $image->move('uploads/profile/', $filename);
                    $profile->image = url('uploads/profile/' . $filename);
                    $profile->save();
                }

                // attach to user
                $user->profile()->save($profile);
                $user->save();
                DB::commit();
                return ResponseHelper::success('Profile created successfully', $user->load('profile'));
            }


            $request->name ? $user->name = $request->name : null;
            $request->email ? $user->email = $request->email : null;
            $request->mobile ? $user->mobile = $request->mobile : null;
            $user->save();

            // Update the profile with the new location
            $request->location ? $user->profile->location = $request->location : null;
            $request->latitude ? $user->profile->latitude = $request->latitude : null;
            $request->longitude ? $user->profile->longitude = $request->longitude : null;
            $request->country ? $user->profile->country = $request->country : null;
            $request->last_name ? $user->profile->last_name = $request->last_name : null;
            $request->bio ? $user->profile->bio = $request->bio : null;
            $request->language ? $user->profile->language = $request->language : null;
            $request->category_id ? $user->profile->category_id = $request->category_id : null;
            $user->profile->save();


            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                $relativePath = parse_url($user->profile->image, PHP_URL_PATH);

                if ($user->profile->image) {
                    if (file_exists(public_path($relativePath))) {
                        unlink(public_path($relativePath));
                    }
                }

                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                $image->move('uploads/profile/', $filename);
                $user->profile->image = url('uploads/profile/' . $filename);
                $user->profile->save();
            }

            // Update the user's profile
            DB::commit();
            return ResponseHelper::success('account updated successfully', $user);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseHelper::error($e->getMessage(), 422);
        }
    }

    // get user info
    public function getFirebase(Request $request)
    {

        return response()->json(auth()->user()->load('firebase'));
    }

    // Logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Get current user (authenticated)
    public function me()
    {
        return response()->json(auth()->user()->load('profile'));
    }

    // Refresh token
    public function refresh()
    {
        return response()->json(['token' => JWTAuth::refresh(JWTAuth::getToken())]);
    }

    // Forgot password
    public function forgotPassword(Request $request)
    {
        // Implement forgot password logic
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $user = User::whereEmail($request->email)->first();

            // Generate a token for the user
            $token = random_int(100000, 999999);

            $existingToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();
            if ($existingToken) {
                DB::table('password_reset_tokens')->where('email', $user->email)->update([
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            } else {
                DB::table('password_reset_tokens')->insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }

            // Send password reset link
            $user->notify(new ForgetPassword($token));

            return response()->json(['success' => true, 'message' => 'Password reset link sent on your email.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->code,
        ])->first();

        if (!$passwordReset) {
            return response()->json(['error' => 'Invalid reset code'], 400);
        }

        $user = User::whereEmail($request->email)->first();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return response()->json(['success' => true, 'message' => 'Password has been reset successfully.']);
    }

    // Change password
    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:8|confirmed|different:current_password',
                'current_password' => 'required|string|',
            ]);

            // Check if the current password is correct
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return ResponseHelper::error('Current password is incorrect', 401);
            }

            auth()->user()->update([
                'password' => bcrypt($request->password),
            ]);

            return ResponseHelper::success('Password changed successfully');
        } catch (\Exception $e) {
            // Provide a more descriptive error response if query fails
            return ResponseHelper::error('Failed to change password: ' . $e->getMessage(), 500);
        }
    }

    // get notifications
    public function getNotifications()
    {
        $notifications = auth()->user()->notifications;
        return ResponseHelper::success('Notifications', $notifications);
    }

    // get unread notifications
    public function getUnreadNotifications()
    {
        $notifications = auth()->user()->unreadNotifications;
        return ResponseHelper::success('Unread Notifications', $notifications);
    }

    // get read notifications
    public function getReadNotifications()
    {
        $notifications = auth()->user()->readNotifications;
        return ResponseHelper::success('Read Notifications', $notifications);
    }

    // get notification
    public function getNotification(Request $request)
    {
        $notification = auth()->user()->notifications->find($request->id);
        if ($notification) {
            return ResponseHelper::success('Notification', $notification);
        }
        return ResponseHelper::error('Notification not found', 404);
    }

    // mark notification as read
    public function markNotificationAsRead(Request $request)
    {
        $notification = auth()->user()->notifications->find($request->id);
        if ($notification) {
            $notification->markAsRead();
            return ResponseHelper::success('Notification marked as read successfully');
        }
        return ResponseHelper::error('Notification not found', 404);
    }

    // account delete
    public function accountDelete(Request $request) {}
}
