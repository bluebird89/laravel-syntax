<?php

use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
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
    return view('welcome');
});

Route::get('hello', function () {
    return 'Hello Laravel!';
});

Route::get('/user', [UserController::class, 'index']);
Route::view('/welcome', 'welcome', ['name' => '学院君']);
Route::get('user/{id}', function ($id) {
    return 'User ' . $id;
});
Route::get('user/{name?}', function ($name = 'John') {
    return $name;
})->where('name', '[A-Za-z]+');
Route::get('user/{id}', 'UserController@show')->where('id', '[0-9]+');
Route::get('user/profile', function () {
    return 'my url: ' . route('profile');
})->name('profile');
Route::get('redirect', function() {
    return redirect()->route('profile');
});
Route::get('api/users/{user}/posts/{post:slug}', function (User $user, Post $post) {
    return $post;
});

// event example
Route::get('event/test', 'OrderController@ship');
Route::get('event', function () {
    $user = User::first();
    \Event::fire('user.login', $user);
    var_dump('fired');
});
