<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
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
    return new \App\Http\Resources\UserResource($request->user());
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout']);//->middleware('auth:sanctum');

Route::group(['prefix'=>'topics', 'middleware'=>'auth:sanctum'], function() {
    Route::post('/', [TopicController::class,'store']);
    Route::get('/', [TopicController::class,'index']);
    Route::get('/{topic}', [TopicController::class,'show']);
    Route::patch('/{topic}', [TopicController::class,'update']);
    Route::delete('/{topic}', [TopicController::class,'destroy']);
});

