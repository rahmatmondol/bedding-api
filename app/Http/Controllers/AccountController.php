<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountDeletionUser;
use App\Mail\AccountDeletionAdmin;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Show the account deletion page
     *
     * @return \Illuminate\View\View
     */
    public function showDeleteAccount()
    {
        return view('account-delete');
    }

    /**
     * Process the account deletion request via AJAX
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAccount(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'reason' => 'required',
            'other_reason' => 'required_if:reason,other',
            'confirm_deletion' => 'accepted'
        ], [
            'password.required' => 'Please enter your current password',
            'reason.required' => 'Please select a reason for deletion',
            'other_reason.required_if' => 'Please specify your reason for deletion',
            'confirm_deletion.accepted' => 'You must confirm that you understand this action is permanent'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => ['password' => ['The password you entered is incorrect']]
            ], 422);
        }

        try {
            // Prepare deletion reason for records
            $fullReason = $request->reason;
            if ($request->reason === 'other' && $request->other_reason) {
                $fullReason = 'Other: ' . $request->other_reason;
            }

            // Additional feedback if provided
            $feedbackText = $request->feedback ? $request->feedback : 'No additional feedback provided';

            // Store deletion information
            $deletionInfo = [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'reason' => $fullReason,
                'feedback' => $feedbackText,
                'deleted_at' => Carbon::now()->toDateTimeString()
            ];

            // Log deletion for record-keeping
            Log::info('Account deletion requested', $deletionInfo);

            // Send email to user
            Mail::to($user->email)->send(new AccountDeletionUser($user->name));

            // Send email to admin
            $adminEmail = config('mail.admin_address', 'rahmat.mondol007@gmail.com');
            Mail::to($adminEmail)->send(new AccountDeletionAdmin($deletionInfo));

            // Perform actual deletion
            // You can choose between soft delete or permanent delete based on your requirements
            // Soft delete:
            // $user->delete();

            // Permanent delete:
            $user->forceDelete();

            // Logout the user - we'll do this via the response
            Auth::logout();

            // Clear session
            // $request->session()->invalidate();
            // $request->session()->regenerateToken();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Your account has been successfully deleted. We\'re sorry to see you go!',
                'redirect' => route('home')
            ]);
        } catch (\Exception $e) {
            Log::error('Account deletion failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
