<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
/* posts routes */
Route::get('/posts',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');

/* comments routes*/
Route::post('posts/{post}/comments', [PostController::class, 'addComment'])->name('comments.store');
Route::put('posts/{post}/comments', [PostController::class, 'EditComment'])->name('comments.update');
Route::delete('posts/{post}/comments', [PostController::class, 'DeleteComment'])->name('comments.destroy');











