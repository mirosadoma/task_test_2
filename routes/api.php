<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostsController;

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

Route::group(['middleware'=>'api'], function () {
    // Auth
    Route::group(['prefix'=>'auth'], function () {
        Route::post('login',[AuthController::Class,'login']); // done
        Route::post('register',[AuthController::Class,'register']); // done
        Route::post('logout',[AuthController::Class,'logout']); // done
    });


    // Posts
    Route::middleware(['auth:sanctum','api'])->prefix("posts")->group(function () {
        Route::get('view_my_posts',[PostsController::Class,'view_my_posts']); // done
        Route::get('view_all_posts',[PostsController::Class,'view_all_posts']); // done
        Route::get('show_post/{post}',[PostsController::Class,'show_post']); // done
        Route::post('add_post',[PostsController::Class,'add_post']); // done
        Route::post('update_post/{post}',[PostsController::Class,'update_post']); // done
        Route::post('delete_post/{post}',[PostsController::Class,'delete_post']); // done
    });
});
