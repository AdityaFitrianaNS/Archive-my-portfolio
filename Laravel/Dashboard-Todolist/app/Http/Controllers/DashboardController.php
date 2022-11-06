<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard/index', [
            'title' => 'Dashboard',
            'image' => 'anime.jpg',
            'name' => 'profile',
            'todolist' => Todolist::where('user_id', auth()->user()->id)->count(),
            'finished' => Todolist::where('status', 'Finished')->where('user_id', auth()->user()->id)->count(),
            'unfinished' => Todolist::where('status', 'Unfinished')->where('user_id', auth()->user()->id)->count(),
            'category' => Category::where('user_id', auth()->user()->id)->count()
        ]);
    }
}
