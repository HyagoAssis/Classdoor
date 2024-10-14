<?php

use App\Http\Controllers\Category;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('categories', Category\StoreController::class)->name('categories.store');
        Route::delete('categories/{category}', Category\DeleteController::class)->name('categories.delete');
        Route::get('categories', Category\IndexController::class)->name('categories.index');
    });
});
