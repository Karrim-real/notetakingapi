<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteBook;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::middleware(['cors'])->group(function(){
    Route::apiResource('book', BookController::class);
});


    Route::apiResource('favouritebook', FavouriteBook::class);

    Route::controller(FavouriteBook::class)->group(function () {
        Route::get('/favourite', 'getUserFavouriteBook')->middleware('auth:sanctum');
        Route::delete('/favourite/{book}', 'DeleteFavourite')->middleware('auth:sanctum');
    });


Route::controller(AuthUserController::class)->group(function(){

    Route::prefix('auth')->group(function(){
        Route::post('/signup', 'create');
        Route::post('/login', 'show');
    });

    Route::prefix('users')->group(function(){
        Route::middleware('auth:sanctum')->group(function(){
            Route::get('/profile', 'index');
            Route::post('/updateprofile', 'update');
            Route::get('/logout', 'destroy');
        });
    });

});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('message', MessageController::class);
    Route::apiResource('comment', CommentController::class);
});


