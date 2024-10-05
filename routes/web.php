<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
    Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
    Route::get('/editar_perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/editar_perfil', [PerfilController::class, 'store'])->name('perfil.store');
    Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('user.follow');
    Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('user.unfollow');
});
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');

// Rutas en las que el usuario debe estar logado
