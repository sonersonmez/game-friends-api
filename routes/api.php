<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [AuthenticationController::class, 'register']);

Route::group(['prefix' => 'users'], function(){
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user_id}', [UserController::class, 'show']);
    Route::put('/{user_id}', [UserController::class, 'update']);
    Route::delete('/{user_id}', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'categories'], function(){
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{category_id}', [CategoryController::class, 'show']);
    Route::put('/{category_id}', [CategoryController::class, 'update']);
    Route::delete('/{category_id}', [CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'games'], function(){
    Route::get('/', [GameController::class, 'index']);
    Route::post('/', [GameController::class, 'store']);
    Route::get('/{game_id}', [GameController::class, 'show']);
    Route::put('/{game_id}', [GameController::class, 'update']);
    Route::delete('/{game_id}', [GameController::class, 'destroy']);
});

Route::group(['prefix' => 'groups'], function(){
    Route::get('/', [GroupController::class, 'index']);
    Route::post('/', [GroupController::class, 'store']);
    Route::get('/{group_id}', [GroupController::class, 'show']);
    Route::put('/{group_id}', [GroupController::class, 'update']);
    Route::delete('/{group_id}', [GroupController::class, 'destroy']);
    Route::post('/{group_id}/add/{user_id}', [GroupController::class, 'addUserToGroup']);
});