<?php

namespace App\Services\Services;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetPasswordRequest;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Services\Constructors\ResetPasswordConstructor;
use Illuminate\Support\Facades\Password;

/**
 * Class ResetPasswordController
 *
 * This controller handles sending password reset emails and performing
 * password reset logic for users who forgot their passwords.
 *
 * It works together with:
 * - Custom FormRequest classes for validation
 * - The User model extension for generating reset password tokens
 * - Laravel's Password Broker for handling password reset flow
 */
class ResetPasswordService implements ResetPasswordConstructor
{
    /**
     * Send Reset Password Link
     *
     * Sends a reset-password email to the user if the provided email exists.
     * This method:
     * - Validates the request using SendResetPasswordRequest
     * - Finds the user by email
     * - Generates a secure reset token
     * - Sends a notification email containing the reset link
     *
     * @param  SendResetPasswordRequest  $request  The validated request containing the user's email.
     * @return bool Returns true if the email was successfully sent, or false if the user does not exist.
     *
     * {@inheritdoc}
     */
    public function sendResetEmail(SendResetPasswordRequest $request): bool
    {
        $request->validated();

        $user = User::where('email', $request->get('email'))->first();

        if (! $user) {
            return false;
        }

        $token = $user->createPasswordResetToken();

        $user->notify(new ResetPasswordNotification($token, $user->email));

        return true;
    }

    /**
     * Reset Password (Forgot Password)
     *
     * Handles resetting a user's password after they request a password reset.
     * This method:
     * - Validates user input using ResetPasswordRequest
     * - Utilizes Laravel's Password Broker to verify token and reset password
     * - Hashes and saves the new password upon successful reset
     *
     * @param  ResetPasswordRequest  $request  Validated data containing email, token, and new password.
     * @return bool Returns true if the password was successfully reset, otherwise false.
     *
     * {@inheritdoc}
     */
    public function resetPassword(ResetPasswordRequest $request): bool
    {
        $data = $request->validated();

        $status = Password::broker()->reset(
            [
                'email' => $data['email'],
                'password' => $data['password'],
                'password_confirmation' => $data['password_confirmation'],
                'token' => $data['token'],
            ],
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET;
    }
}
