<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Admin\PermissionController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::resource('admins',AdminController::class);
    Route::get('toggle-status/{id}',[AdminController::class,'toggleStatus']);
    Route::get('get-profile', [ProfileController::class, 'getProfile']);
    Route::put('edit-profile', [ProfileController::class, 'updateProfile']);
    Route::post('change-Password', [ChangePasswordController::class, 'changePassword']);
        Route::get('permissions',[PermissionController::class ,'index']);
    Route::post('permissions/{admin_id}',[PermissionController::class ,'store']);
});
