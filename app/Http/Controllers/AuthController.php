<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no' => 'required'
        ]);

        $user = User::where('no', $request->no)->first();

        if (!$user) {
            return back()->with('error', 'Nomor tidak ditemukan');
        }

        // Belum registrasi
        if (empty($user->email) || empty($user->password)) {

            session([
                'register_user_id' => $user->id
            ]);

            return redirect()->route('register.form');
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function registerForm()
    {
        if (!session()->has('register_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::find(session('register_user_id'));

        if (!$user) {
            return redirect()->route('login');
        }

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('register_user_id');

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}