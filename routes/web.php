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

Route::get('hello', function () {
    return 'Hello Laravel!';
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', 'UsersController@index');
//Route::get('/user', [UserController::class, 'index']);

# method
//Route::get($uri, $callback);
//Route::post($uri, $callback);
//Route::put($uri, $callback);
//Route::patch($uri, $callback);
//Route::delete($uri, $callback);
//Route::options($uri, $callback);
Route::match(['get', 'post'], '/', function () {
    //
});
Route::any('foo', function () {
    //
});

# 路由参数
//Route::get('user/{id}', function ($id) {
//    return 'User ' . $id;
//});
//Route::get('user/{id}', 'UserController@show')->where('id', '[0-9]+');
Route::get('page/{id}/{slug}', function ($id, $slug) {
    return $id . ':' . $slug;
})->where(['id' => '[0-9]+', 'slug' => '[A-Za-z]+']);
Route::get('user/{name?}', function ($name = 'John') {
    return $name;
})->where('name', '[A-Za-z]+');

Route::redirect('/here', '/there', 301);

Route::view('layout', 'child');
Route::view('layout/blade', 'child_blade', [
    'name' => 'henry',
    'countries' => ['China', 'Japan', 'Korea']
]);

// 模型绑定
Route::get('task/{id}', function ($id) {
    $task = \App\Models\Task::findOrFail($id);
});
// 隐式绑定
Route::get('api/users/{user}/posts/{post:slug}', function (User $user, Post $post) {
    return $post;
});

## 路由命名 <a href="{{ route('user.profile', ['id' => 100]) }}">  // 输出：http://blog.test/user/100
Route::get('user/profile', 'UserController@showProfile')->name('user.profile');

# Group + middleware
//Route::middleware(['first', 'second'])->group(function () {
//    Route::get('/', function () {
//    });
//    Route::get('user/profile', function () {
//    });
//});

// 子命名空间
Route::namespace('Admin')->group(function () {
    // App\Http\Controllers\Admin\AdminController
    Route::get('/admin', 'AdminController@index');
});
// 子域名路由 默认的命名空间是 App\Http\Controllers
Route::domain('{account}.myapp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});
// 前缀
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // 匹配包含 "/admin/users" 的 URL
    });
});

Route::get('user/{user}', [UserController::class, 'show']);
Route::get('user/{user}', \App\Http\Controllers\ShowProfile::class);

// 隐式模型绑定
Route::get('api/users/{user}', function (User $user) {
    return $user->email;
});

Route::get('user/profile', function () {
    return 'my url: '.route('profile');
})->name('profile');
Route::get('redirect', function () {
    return redirect()->route('profile');
});

Route::resource('posts', \App\Http\Controllers\PostController::class, [
    'only' =>
        ['index', 'show']
    , 'except' =>
        ['create', 'store', 'update', 'destroy']
]);

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/user', function () {
        //
    });
});

Route::fallback(function () {
    return '我是最后的屏障';
});

Route::get('/task', 'TaskController@hindex');
Route::get('task/create', 'TaskController@create');
Route::post('task', 'TaskController@store');
Route::get('task/{id}/delete', function ($id) {
    return '<form method="post" action="' . route('task.delete', [$id]) . '">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">删除任务</button>
            </form>';
});
Route::delete('task/{id}', function ($id) {
    return 'Delete Task ' . $id;
})->name('task.delete');

// event example
Route::get('event/test', 'OrderController@ship');
Route::get('event', function () {
    $user = User::first();
    \Event::fire('user.login', $user);
    var_dump('fired');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
