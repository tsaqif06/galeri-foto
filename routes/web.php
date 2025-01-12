<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;


// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard')->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/{username}', [UserController::class, 'profile'])->name('profile.show');
Route::get('/photo/{slug}', [PhotoController::class, 'show'])->name('photo.show');
