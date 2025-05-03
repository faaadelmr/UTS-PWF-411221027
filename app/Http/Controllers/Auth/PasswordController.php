<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            // Log untuk debugging
            Log::info('Updating password for user: ' . $request->user()->username);
            
            // Gunakan password_hash sebagai nama kolom
            $request->user()->forceFill([
                'password_hash' => Hash::make($validated['password']),
            ])->save();

            return back()->with('status', 'password-updated');
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Password update failed: ' . $e->getMessage());
            
            return back()->with('error', 'Failed to update password: ' . $e->getMessage());
        }
    }
}
