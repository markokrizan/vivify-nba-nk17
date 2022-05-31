<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // Auth::login($user); // Nema vise smisla ulogovati user-a - mora prvo da verifikuje mejl

        // https://laravel.com/docs/9.x/verification#main-content
        event(new Registered($user));

        return redirect('/login');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->validated())) {
            return redirect('/teams');
        }

        return view('auth.login', ['invalid_credentials' => true]);
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }
}
