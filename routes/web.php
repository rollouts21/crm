<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::name('clients.')->prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::get('/create', [ClientController::class, 'create'])->name('create');
        Route::post('/store', [ClientController::class, 'store'])->name('store');
        Route::get('/{client}', [ClientController::class, 'show'])->name('show');
        Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::patch('/{client}', [ClientController::class, 'update'])->name('update');
        Route::delete('/{client}', [ClientController::class, 'destroy'])->name('destroy');
        Route::name('deals.')->prefix('{client}/deals')->group(function () {
            Route::get('/create', [DealsController::class, 'create'])->name('create');
            Route::post('/store', [DealsController::class, 'store'])->name('store');
            Route::get('/{deal}', [DealsController::class, 'show'])->name('show');
            Route::get('/{deal}/edit', [DealsController::class, 'edit'])->name('edit');
            Route::patch('/{deal}', [DealsController::class, 'update'])->name('update');
            Route::delete('/{deal}', [DealsController::class, 'destroy'])->name('destroy');
            Route::name('tasks.')->prefix('{deal}/tasks')->group(function () {
                Route::get('/create', [TaskController::class, 'create'])->name('create');
                Route::post('/store', [TaskController::class, 'store'])->name('store');
                Route::get('/{task}', [TaskController::class, 'show'])->name('show');
                Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
                Route::patch('/{task}', [TaskController::class, 'update'])->name('update');
                Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
            });
        });
    });
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePass'])->name('profile.updatePass');
    Route::get('/deals', [DealsController::class, 'index'])->name('deals.index');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/{log}', [LogController::class, 'show'])->name('logs.show');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
