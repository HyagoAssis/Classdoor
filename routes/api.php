<?php

use App\Http\Controllers\{ClassifiableItem};
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('admin')->group(function () {

        //region Categories
        Route::post('categories', \App\Http\Controllers\Api\Category\StoreController::class)->name('categories.store');
        Route::delete('categories/{category}', \App\Http\Controllers\Api\Category\DeleteController::class)->name('categories.delete');
        Route::get('categories', \App\Http\Controllers\Api\Category\IndexController::class)->name('categories.index');
        //endregion

        //region ClassificationTypes
        Route::post('classification_types', \App\Http\Controllers\Api\ClassificationType\StoreController::class)->name('classification_types.store');
        Route::delete('classification_types/{classificationType}', \App\Http\Controllers\Api\ClassificationType\DeleteController::class)->name('classification_types.delete');
        Route::put('classification_types/{classificationType}', \App\Http\Controllers\Api\ClassificationType\UpdateController::class)->name('classification_types.update');
        Route::get('classification_types', \App\Http\Controllers\Api\ClassificationType\IndexController::class)->name('classification_types.index');
        //endregion

        //region ClassifiableItem
        Route::delete('classifiable_items/{classifiableItem}', \App\Http\Controllers\Api\ClassifiableItem\DeleteController::class)->name('classifiable_items.delete');
        //endregion
    });

    Route::post('classifiable_items', \App\Http\Controllers\Api\ClassifiableItem\StoreController::class)->name('classifiable_items.store');

    Route::post('classifications', \App\Http\Controllers\Api\Classification\StoreController::class)->name('classifications.store');

});

Route::get('classifiable_items', \App\Http\Controllers\Api\ClassifiableItem\IndexController::class)->name('classifiable_items.index');
Route::get('classifications', \App\Http\Controllers\Api\Classification\IndexController::class)->name('classifications.index');
