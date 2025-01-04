<?php

use App\Http\Controllers\{
    Api\Category,
    Api\ClassifiableItem,
    Api\Classification,
    Api\ClassificationType
};
use Illuminate\Support\Facades\Route;

Route::group(['domain' => config('app.url')], function () {
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

            //region ClassifiableItem
            Route::delete('classifiable_items/{classifiableItem}', ClassifiableItem\DeleteController::class)->name('classifiable_items.delete');
            //endregion
        });

        Route::post('classifiable_items', ClassifiableItem\StoreController::class)->name('classifiable_items.store');

        Route::post('classifications', Classification\StoreController::class)->name('classifications.store');
    });

    Route::get('classifiable_items', ClassifiableItem\IndexController::class)->name('classifiable_items.index');
    Route::get('classifications', Classification\IndexController::class)->name('classifications.index');
});
