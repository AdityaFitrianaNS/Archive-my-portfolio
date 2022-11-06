<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardTodolistController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\DashboardStatusController;

// Route home
Route::get('/', function () {
    return view('login/index', [
        "title" => "Home",
        "image" => "anime.jpg",
    ]);
});

// Route login
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route group register
Route::controller(RegisterController::class)->group(function() {
    Route::get('/register', 'create')->middleware('guest');
    Route::post('/register', 'store');
});

// Route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route todolist
Route::resource('/todolists', DashboardTodolistController::class)->middleware('auth');

// Route category
Route::resource('/categories', DashboardCategoryController::class)->middleware('auth');

// Route group task finished and unfinished
Route::controller(DashboardStatusController::class)->middleware('auth')->group(function(){
    Route::get('/todolist/status/finished', 'finished');
    Route::get('/todolist/status/unfinished', 'unfinished');
});

// Route profile
Route::get('/profile', [DashboardProfileController::class, 'index'])->middleware('auth');
