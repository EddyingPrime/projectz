<?php


// routes/web.php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardGameController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;



// BoardGames route
Route::get('/boardgames', [BoardGameController::class, 'index'])->name('boardgames');
Route::post('/boardgames', [BoardGameController::class, 'store'])->name('boardgames.store'); // Adjust the method and controller as needed
Route::get('/boardgames/add', [BoardGameController::class, 'create'])->name('boardgames.add');
Route::get('/boardgames/{id}', [BoardGameController::class, 'show'])->name('boardgames.show');



// Admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

