<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CardListController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['middleware' => ['auth', 'verified'], 'controller' => BoardController::class], function(){
    Route::get('/boards', 'index')->name('boards');
    Route::get('/boards/{board}', 'show')->name('board');
    Route::post('/boards', 'store')->name('store');
    Route::put('/boards/{board}', 'update')->name('update');
});

Route::group(['controller' => CardListController::class], function(){
    Route::post('boards/{board}/lists', 'store')->name('cardsList');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
