<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;


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

Route::post('/follow/{username}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{username}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::post('/photos/{photoId}/like', [LikeController::class, 'toggleLike']);

Route::post('/photos/{photoId}/comments', [CommentController::class, 'addComment']);
Route::put('/comments/{commentId}', [CommentController::class, 'updateComment']);
Route::delete('/comments/{commentId}', [CommentController::class, 'deleteComment']);

Route::post('/photos/{photoId}/favorite', [FavoriteController::class, 'toggleFavorite']);

Route::post('/albums', [AlbumController::class, 'createAlbum']);
Route::put('/albums/{albumId}', [AlbumController::class, 'updateAlbum']);
Route::delete('/albums/{albumId}', [AlbumController::class, 'deleteAlbum']);
Route::post('/albums/{albumId}/photos', [AlbumController::class, 'addPhotoToAlbum']);
