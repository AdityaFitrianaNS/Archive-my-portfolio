<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardProfileController extends Controller
{
    public function index()
    {
        return view('dashboard/profile/index', [
            'title' => 'Profile' . auth()->user()->name,
            'user' => User::where('id', auth()->user()->id)->get()
        ]);
    }
}
