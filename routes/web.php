<?php

use App\Http\Controllers\Site\ClassifiableManagerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['domain' => config('app.url_admin')], function () {
    Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
    });
});

Route::group(['domain' => config('app.url')], function () {
    Route::get('/', function () {
        return Inertia::render('Site/Home');
    })->name('home');

    Route::get('/disciplinas', function () {
        return Inertia::render('Site/DisciplinesList');
    })->name('disciplines');

    Route::get('/professores', function () {
        return Inertia::render('Site/TeachersList');
    })->name('teachers');

    Route::get('/locais', function () {
        return Inertia::render('Site/PlacesList');
    })->name('places');

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/classificado/novo', ClassifiableManagerController::class)->name('classifiable_manager.new');
        Route::get('/classificado/{classifiableItem}', ClassifiableManagerController::class)->name('classifiable_manager.show');
    });
});

require __DIR__ . '/auth.php';
