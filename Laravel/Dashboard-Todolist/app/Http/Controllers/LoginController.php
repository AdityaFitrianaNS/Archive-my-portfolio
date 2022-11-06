<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $users = $request->validate([
            'email' => ['required', 'min:5'],
            'password' => ['required', Password::min(5)]
        ]);

        // Jika percobaan login users berhasil
        if (Auth::attempt($users, $request->remember)) {
            // Maka akan redirect / pindahkan
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        // Jika gagal, kembalikan beserta pesan error
        if (!Auth::attempt($users, $request->remember)) {
            return back()->with('loginError', 'Login Failed!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
