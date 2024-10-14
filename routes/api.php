<?php

use App\Http\Controllers\Category;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('categories', Category\StoreController::class)->name('categories.store');
    });
});
