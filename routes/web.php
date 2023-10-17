<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::controller(RegisterController::class)->group(function(){
    Route::get('/crear-cuenta','index')->name('craer-cuenta.index');
    Route::post('/crear-cuenta','store')->name('craer-cuenta.store');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login');
});

Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::controller(PerfilController::class)->group(function(){
    Route::get('/editar-perfil','index')->name('perfil.index');
    Route::post('/editar-perfil','store')->name('perfil.store');
});

Route::controller(PostController::class)->group(function(){
    Route::get('/{user:username}', 'index')->name('posts.index');
    Route::get('/posts/create', 'create')->name('posts.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/posts/{user:username}/posts/{post}', 'show')->name('posts.show');
    Route::delete('/posts/{post}/', 'destroy')->name('posts.destroy');
});

Route::post('/{user:username}/posts/{post}',[ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

Route::controller(LikeController::class)->group(function(){
    Route::post('/posts/{post}/likes','store')->name('posts.likes.store');
    Route::delete('/posts/{post}/likes','destroy')->name('posts.likes.destroy');
});

Route::controller(FollowerController::class)->group(function(){
    Route::post('/{user:username}/follow','store')->name('users.follow');
    Route::delete('/{user:username}/unfollow','destroy')->name('users.unfollow');
});

