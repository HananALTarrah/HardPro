<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\UploadManager;
use App\Http\Controllers\MailController;

Route::get("/forget-password",[ForgetPasswordManager::class,"forgetPassword"])
     ->name("forget.password");

     Route::get('/csrf-token', function () {
        return response()->json(['token' => csrf_token()]);
    });

// هذا الرابط لإعادة تعيين كلمة المرور الخاصة بالمستخدم لذا نمرر رمز مميز
//  تتغير قيمته حسب القيمة التي نمررها /{token}
Route::get("/reset-password/{token}",[ForgetPasswordManager::class,"resetPassword"])
     ->name("reset.password");

Route::get('/email', [MailController::class, 'sendEmail']);

