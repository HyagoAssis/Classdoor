<?php

use App\Http\Controllers\{Category, ClassificationType};
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('admin')->group(function () {

        //region Categories
        Route::post('categories', Category\StoreController::class)->name('categories.store');
        Route::delete('categories/{category}', Category\DeleteController::class)->name('categories.delete');
        Route::get('categories', Category\IndexController::class)->name('categories.index');
        //endregion

        //region ClassificationTypes
        Route::post('classification_types', ClassificationType\StoreController::class)->name('classification_types.store');
        Route::delete('classification_types/{classificationType}', ClassificationType\DeleteController::class)->name('classification_types.delete');
        Route::put('classification_types/{classificationType}', ClassificationType\UpdateController::class)->name('classification_types.update');
        Route::get('classification_types', ClassificationType\IndexController::class)->name('classification_types.index');
        //endregion
    });
});
