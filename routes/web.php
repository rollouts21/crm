<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('companies')->name('companies.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CompaniesController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\CompaniesController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\CompaniesController::class, 'store'])->name('store');
    Route::patch('/{company}', [\App\Http\Controllers\CompaniesController::class, 'update'])->name('update');
});
require __DIR__.'/auth.php';
