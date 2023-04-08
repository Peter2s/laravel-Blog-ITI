<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('posts')->middleware('auth')->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('posts.index');
    Route::get('/create', 'create')->name('posts.create');
    Route::get('/{post}/edit', 'edit')->name('posts.edit');
    Route::get('/{post}', 'show')->name('posts.show');
    Route::post('', 'store')->name('posts.store');
    Route::patch('/{post}', 'update')->name('posts.update');
    Route::delete('/{post}', 'destroy')->name('posts.destroy');
    Route::put('/{post}/restore', 'restore')->name('posts.restore');

    /* comments routes*/
    Route::post('/{post}/comments','addComment')->name('comments.store');
    Route::put('/{post}/comments/{comment}', 'EditComment')->name('comments.update');
    Route::delete('/{post}/comments/{comment}','DeleteComment')->name('comments.destroy');

});





Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

