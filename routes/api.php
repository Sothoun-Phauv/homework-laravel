<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

//public
Route::get('posts/{id}',[ControllerStudent::class,'show']);
Route::get('posts',[ControllerStudent::class,'index']);
Route::get('users',[UserController::class,'index']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

//private route
Route::group(['middleware'=>['auth:sanctum']],function(){
    //user
    Route::post('posts',[ControllerStudent::class,'store']);
    Route::put('posts/{id}',[ControllerStudent::class,'update']);
    Route::delete('posts/{id}',[ControllerStudent::class,'destroy']);

    Route::Post('logout',[UserController::class],'logout');
});
