<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 Route::post('/sing',[UserController::class, 'sing']);
 Route::post('/login',[UserController::class, 'login']);
 Route::get('/logged',[UserController::class, 'logout'])->middleware('auth:sanctum');


 //post
Route::middleware('auth:sanctum')->group(function () {
Route::post('/store',[PostController::class, 'Store']);
Route::delete('/post/{id}',[PostController::class, 'destroy']);
Route::get('/allpost',[PostController::class, 'show']);
Route::post('/update/{id}',[PostController::class, 'editpost']);
Route::get('single/{id}',[PostController::class, 'single']);

});
