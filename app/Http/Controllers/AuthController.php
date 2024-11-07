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

        return response()->json(compact('token'));
    }

    // Set location
    public function setLocation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
        ]);
    
        // Check if the user is authenticated
        $user = auth()->user();
    
        if (!$user) {
            return ResponseHelper::error('User not authenticated', 401);
        }
    
        // Get the user's profile
        $profile = $user->profile;
        if (!$profile) {
            return ResponseHelper::error('Profile not found', 404);
        }
    
        // DB::beginTransaction();
    
        try {

            // check if location already exists
            if ($profile->location) {
                $location = $profile->location()->update([
                    'name' => $request->name,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ]);
            }else{
                $location = Locations::create([
                    'name' => $request->name,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                ]);
        
                $profile->location()->associate($location);
            }

            // Update the user's profile
            // DB::commit();
            return ResponseHelper::success('Location set successfully', $profile);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseHelper::error('Failed to set location: ' . $e->getMessage(), 500);
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
