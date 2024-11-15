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

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'country' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'account_type' => 'required|string',
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'mobile' => $validated['mobile'],
            ]);

            // Assign role to user after registration
            if (isset($validated['account_type'])) {
                $role = $validated['account_type'] === 'provider' ? 'provider' : 'customer';
                $user->assignRole($role);
            }

            // Create profile for the user
            $profile = $user->profile()->create([
                'country' => $validated['country'],
                'last_name' => $validated['last_name'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'language' => $validated['language'] ?? 'English',
                'image' => $validated['image'] ?? null,
            ]);

            // attach category to profile
            $profile->category()->associate($validated['category_id']);
            $profile->save();

            // If everything goes well, commit the transaction
            DB::commit();

            return ResponseHelper::success('User Created Successfully', $user);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollBack();

            return ResponseHelper::error('User registration failed: ' . $e->getMessage(), 500);
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

        $user = auth()->user()->load('profile');

        return response()->json(compact('token', 'user'));
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
            $profile = $user->profile;
            if (!$profile) {
                // Create a new profile for the user
                $profile = $user->profile()->create([
                    'user_id' => $user->id ?? null,
                    'location' => $request->name ?? null,
                    'latitude' => $request->latitude ?? null,
                    'longitude' => $request->longitude ?? null,
                    'country' => $request->country ?? null,
                    'last_name' => $request->last_name ?? null,
                    'bio' => $request->bio ?? null,
                    'language' => $request->language ?? 'English',
                ]);
            }
        
            $request->name ? $user->name = $request->name : null;
            $request->email ? $user->email = $request->email : null;
            $request->mobile ? $user->mobile = $request->mobile : null;
            $user->save();

            // Update the profile with the new location
            $profile->location = $request->name ?? null;
            $profile->latitude = $request->latitude ?? null;
            $profile->longitude = $request->longitude ?? null;
            $profile->country = $request->country ?? null;
            $profile->last_name = $request->last_name ?? null;
            $profile->bio = $request->bio ?? null;
            $profile->language = $request->language ?? 'English';
    
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                $relativePath = parse_url($profile->image, PHP_URL_PATH);
                if (file_exists(public_path($relativePath))) {
                    unlink(public_path($relativePath)); // Deletes the file
                }

                $image = $request->file('image');
                $originalName = $image->getClientOriginalName();
                $filename = time() . '_' . $originalName;

                $image->move('uploads/profile/', $filename);
                $profile->image = url('uploads/profile/' . $filename);
            }
            // Save the updated profile
            $profile->save();
            
            // Update the user's profile
            DB::commit();
            return ResponseHelper::success('account updated successfully', $user);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseHelper::error('account update failed:' . $e->getMessage(), 500);
        }
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
        return response()->json(auth()->user());
    }

    // Refresh token
    public function refresh()
    {
        return response()->json(['token' => JWTAuth::refresh(JWTAuth::getToken())]);
    }

    // Forgot password
    public function forgotPassword(Request $request)
    {
        // Implement password reset logic
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        // Implement password reset logic
    }

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Password changed successfully']);
    }
}
