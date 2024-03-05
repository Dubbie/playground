<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param string $email
     * @param $password
     * @return mixed
     */
    public function login(string $email, $password)
    {
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            return response()->json([
                'message' => 'logged in',
                'success' => true
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to log in.',
                'success' => false,
            ], 400);
        }
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function register(string $name, string $email, string $password)
    {
        try {

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);

            // Login the user
            Auth::login($user);

            return response()->json([
                'message' => 'ok',
                'success' => true,
            ], 201);
        } catch (Exception) {
            return response()->json([
                'message' => 'error while storing user in db',
                'success' => false
            ], 500);
        }
    }
}
