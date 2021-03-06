<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');

Route::get('/new', function () {
    return view('posts.create');
})->name('create_post');

Route::get('/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit']);

Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show']);












//require __DIR__.'/auth.php';

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
