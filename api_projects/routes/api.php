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

Route::post('store',[PostController::class, 'store']);
Route::get('allpost',[PostController::class, 'index']);
Route::get('post/{id}',[PostController::class, 'show']);
Route::put('updatepost',[PostController::class, 'update']);
Route::delete('postdel/{id}',[PostController::class, 'destroy']);
