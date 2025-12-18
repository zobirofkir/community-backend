<?php

namespace App\Services\Constructors;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetPasswordRequest;

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
interface ResetPasswordConstructor
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
     */
    public function sendResetEmail(SendResetPasswordRequest $request): bool;

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
     */
    public function resetPassword(ResetPasswordRequest $request): bool;
}
