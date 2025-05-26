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

    Route::get('/denuncias', function () {
        return Inertia::render('Site/Complaints');
    })->name('complaints')->middleware(['auth:sanctum', 'verified']);

    Route::get('/perfil', function () {
        return Inertia::render('Site/Profile');
    })->name('profile')->middleware(['auth:sanctum', 'verified']);

    Route::get('/classificado/novo', ClassifiableManagerController::class)->name('classifiable_manager.new')->middleware(['auth:sanctum', 'verified']);

    Route::get('/classificado/{classifiableItem}', ClassifiableManagerController::class)->name('classifiable_manager.show');

    require __DIR__ . '/auth.php';
});
