<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ForgetPasswordManager;


Route::post('/register',[AuthManager::class,'registerPost']);
Route::post('/login',[AuthManager::class,'loginPost']);
Route::post('/logout',[AuthManager::class,'logout']);

Route::post('password/email', [ForgetPasswordManager::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ForgetPasswordManager::class, 'resetPassword']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});