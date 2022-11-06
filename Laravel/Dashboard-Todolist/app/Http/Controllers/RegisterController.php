<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.index', [
            'title' => 'Register Account'
        ]);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'max:100', 'alpha'],
            'username' => ['required', 'min:5', 'max:50', 'unique:users'],
            'email' => ['required', 'min:5', 'max:100', 'email:dns', 'unique:users'],
            'password' => ['required', Password::min(5)->mixedCase()->letters()->numbers()->symbols()->uncompromised(), 'max:50'],
            // 'password' => ['required', Password::min(5), 'max:50'],
        ]);

        $validation['password'] = Hash::make($validation['password']);
        User::create($validation);

        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}