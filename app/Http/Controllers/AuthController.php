<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
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
            'no_rkm_medis' => 'required'
        ]);

        $pasien = Pasien::find($request->no_rkm_medis);

        if (!$pasien) {
            return back()->with('error', 'Nomor RM tidak ditemukan');
        }

        if (empty($pasien->email)) {

            session([
                'register_pasien' => $pasien->no_rkm_medis
            ]);

            return redirect()->route('register.form');
        }

        Auth::login($pasien);

        return redirect()->route('dashboard.index');
    }

    public function registerForm()
    {
        if (!session()->has('register_pasien')) {
            return redirect()->route('login');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $pasien = Pasien::find(
            session('register_pasien')
        );

        if (!$pasien) {
            return redirect()->route('login');
        }

        $pasien->email = $request->email;
        $pasien->password = Hash::make($request->password);
        $pasien->save();

        session()->forget('register_pasien');

        Auth::login($pasien);

        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}