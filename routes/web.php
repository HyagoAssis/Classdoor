<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\ClassifiableManagerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

    Route::get('/classificado/{classifiableItem}', ClassifiableManagerController::class)->name('classifiable_manager.show');

    Route::middleware('auth')->group(function () {
        Route::get('/perfil', function () {
            return Inertia::render('Site/Profile');
        })->name('profile');

        Route::get('/classificado/novo', ClassifiableManagerController::class)->name('classifiable_manager.new');

        Route::get('/denuncias', function () {
            return Inertia::render('Site/Complaints');
        })->name('complaints')->middleware(['admin']);

        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
});
