<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
    });
});

require __DIR__ . '/auth.php';
