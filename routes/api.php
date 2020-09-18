<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/languages', function () {
    $values = collect(['PHP', 'JavaScript', 'Golang']);
    return $values->map(function ($value, $key) {
        $obj = new stdClass();
        $obj->id = $key + 1;
        $obj->name = $value;
        return $obj;
    });
});

Route::get('/posts/fetch', [PostController::class, 'fetch']);
