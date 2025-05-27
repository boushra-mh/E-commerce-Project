<?php

use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [AdminController::class, 'login']);
Route::post('logout', [AdminController::class, 'logout']);
Route::get('get-profile', [ProfileController::class, 'getProfile'])->middleware('auth:admin');
Route::put('edit-profile', [ProfileController::class, 'updateProfile'])->middleware('auth:admin');

