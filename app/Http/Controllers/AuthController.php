<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function doLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        return $this->userService->login($data['email'], $data['password']);
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    public function doRegister(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        return $this->userService->register($data['name'], $data['email'], $data['password']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }
}
