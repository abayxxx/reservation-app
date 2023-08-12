<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();
            $credentialsLogin = [
                'username' => $credentials['username'],
                'password' => $credentials['password'],
            ];
            if (auth()->attempt($credentialsLogin)) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->back()->withInput()->withErrors('Invalid credentials');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
}
