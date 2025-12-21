<?php

namespace App\Services\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateCurrentAuthUserRequest;
use App\Http\Resources\CurrentAuthUserResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AuthService implements AuthConstructor
{
    /**
     * Register a new user in the system
     *
     * - Validate user input through RegisterRequest
     * - Create user record with hashed password (from model mutator)
     * - Assign role selected by user
     * - Return user details formatted in RegisterResource
     */
    public function register(RegisterRequest $request): RegisterResource
    {
        $data = $request->validated();

        /**
         * Default avatar and cover paths in public folder
         */
        $defaultAvatarPath = 'avatars/default.png';  // in public/avatars/
        $defaultCoverPath = 'covers/cover-default.png';  // in public/covers/

        /**
         * Copy default avatar to storage and get storage path
         */
        if (file_exists(public_path($defaultAvatarPath))) {
            $avatarContent = file_get_contents(public_path($defaultAvatarPath));
            $avatarStoragePath = 'avatars/' . uniqid() . '_default.png';
            Storage::disk('public')->put($avatarStoragePath, $avatarContent);
            $data['avatar'] = $avatarStoragePath;
        } else {
            $data['avatar'] = 'avatars/default.png';
        }

        /**
         * Copy default cover to storage and get storage path
         */
        if (file_exists(public_path($defaultCoverPath))) {
            $coverContent = file_get_contents(public_path($defaultCoverPath));
            $coverStoragePath = 'covers/' . uniqid() . '_cover-default.png';
            Storage::disk('public')->put($coverStoragePath, $coverContent);
            $data['cover'] = $coverStoragePath;
        } else {
            
            /**
             * Fallback if default file doesn't exist
             */
            $data['cover'] = 'covers/cover-default.png';
        }

        /**
         * Upload custom avatar if provided
         */
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')
                ->storeAs(
                    'avatars',
                    uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension(),
                    'public'
                );
        }

        /**
         * Upload custom cover if provided
         */
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')
                ->storeAs(
                    'covers',
                    uniqid() . '.' . $request->file('cover')->getClientOriginalExtension(),
                    'public'
                );
        }

        $user = User::create($data);

        return RegisterResource::make($user);
    }
    /**
     * Authenticate an existing user
     *
     * - Check credentials submitted from LoginRequest
     * - Verify password against stored hash
     * - On failure → return 401 Unauthorized
     * - On success → return user details formatted in LoginResource
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $loginValue = $validated['login'];

        $user = User::where(function ($query) use ($loginValue) {
            $query->where('email', $loginValue)
                ->orWhere('username', $loginValue);
        })->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            abort(401, 'Invalid credentials.');
        }

        /**
         * Generate token (assuming you have this in User model)
         */
        $token = $user->createToken('accessToken')->plainTextToken;
        
        /**
         * Set token in HTTP-only cookie
         */
        $cookie = cookie(
            'accessToken',
            $token,
            config('sanctum.expiration', 60 * 24 * 7), // 7 days
            '/',
            null,
            true, 
            false,
            'Strict'
        );

        return LoginResource::make($user)
            ->response()
            ->withCookie($cookie);
    }

    /**
     * Get the currently authenticated user
     *
     * - Fetch authenticated user via Auth::user()
     * - Return transformed response using CurrentAuthUserResource
     */
    public function me(): CurrentAuthUserResource
    {
        $user = Auth::user();
        $user->load('posts');
        return CurrentAuthUserResource::make($user);
    }

    /**
     * Update CUrrent Authenticated User
     * - Validate user input through UpdateCurrentAuthUserRequest
     * - Update user details in the database
     * - Return updated user details formatted in CurrentAuthUserResource
     */
    public function updateCurrentUser(UpdateCurrentAuthUserRequest $request): CurrentAuthUserResource
    {
        $user = Auth::user();
        $data = $request->validated();

        if (array_key_exists('avatar', $data)) {
            unset($data['avatar']);
        }

        if (array_key_exists('password', $data)) {
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }
        }

        if (array_key_exists('password_confirmation', $data)) {
            unset($data['password_confirmation']);
        }

        $user->update($data);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();
        }

        if ($request->hasFile('cover')) {
            if ($user->cover && Storage::disk('public')->exists($user->cover)) {
                Storage::disk('public')->delete($user->cover);
            }

            $path = $request->file('cover')->store('covers', 'public');
            $user->cover = $path;
            $user->save();
        }

        return CurrentAuthUserResource::make($user);
    }

    /**
     * Delete Current Authenticated User
     *
     * - Revoke all active tokens for the user (if using Sanctum/Passport)
     * - Permanently delete the user account
     * - Returns true if deletion was successful
     */
    public function deleteCurrentUser(): bool
    {
        $user = Auth::user();

        return $user->delete();
    }

    /**
     * Logout the current authenticated user
     *
     * - Revoke active API token for user
     * - Force re-authentication for future requests
     */
    public function logout(): bool
    {
        return Auth::user()->token()->revoke();
    }
}
