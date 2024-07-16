<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\Admin\LoginController;

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
   
    // Route::middleware('auth:admin-api')->group(function () {
        // Route::get('/dashboard', [AdminController::class, 'dashboard']);
        // أضف المزيد من المسارات الخاصة بالمدراء هنا
    // });
});


Route::post('/register',[AuthManager::class,'registerPost']);
Route::post('/login',[AuthManager::class,'loginPost']);
Route::post('/logout',[AuthManager::class,'logout']);

Route::put('/user/{user}/update', [AuthManager::class, 'updateUser']);
Route::get('/user/search', [AuthManager::class, 'search']);


Route::post('password/email', [ForgetPasswordManager::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ForgetPasswordManager::class, 'resetPassword']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});