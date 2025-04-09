<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::controller(ProductController::class)->group(function () {
//     Route::get('/products', "index");
//     Route::post('/products/store',  "store");
//     Route::put('/products/{id}', "update");
//     Route::delete('/products/{id}', "destroy");
//     Route::get('/products/{id?}', "show");
// });
Route::resource('products', ProductController::class);
