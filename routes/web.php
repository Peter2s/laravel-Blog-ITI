<?php

use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login-github');

Route::get('/auth/callback', function () {

    $githubUser = Socialite::driver('github')->stateless()->user();

    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->name,
        'github_id' => $githubUser->id,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/posts');
});


Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();

})->name('google');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'google_id' => $googleUser->id,

    ]);

    Auth::login($user);

    return redirect('/posts');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

