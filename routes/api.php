<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardGameController;
use App\Http\Controllers\ForumController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\ReservationController; 

// Registration
Route::post('/register', [UserController::class, 'register']);

// Login
Route::post('/login', [UserController::class, 'login']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// User Profile
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth:sanctum');

// Update Avatar
Route::post('/update-profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::get('/update-profile', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');

// Threads
Route::get('/threads', [ForumController::class, 'getAllThreads']);
Route::get('/threads/{threadId}/comments', [ForumController::class, 'getCommentsForThreads']);

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/threads', [ForumController::class, 'createThread']);
    Route::get('/threads/{id}', [ForumController::class, 'getThread']);
    Route::post('/threads/{threadId}/comments', [ForumController::class, 'createComment']);
    Route::post('/threads/{threadId}/upvote', [ForumController::class, 'upVote']);
    Route::get('/threads/{threadId}/upvote', [ForumController::class, 'upVote']);
    Route::delete('/threads/{threadId}/upvote', [ForumController::class, 'removeUpvote']);
});

// // API Routes for Reservations
// Route::prefix('api')->group(function () {
//     Route::get('/reservations', [ReservationController::class, 'index']);
//     Route::get('/reservations/{id}', [ReservationController::class, 'show']);
//     Route::post('/reservations', [ReservationController::class, 'store']);
//     Route::put('/reservations/{id}', [ReservationController::class, 'update']);
//     Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
// });

// Board Games Routes
Route::prefix('/board-games')->group(function () {
    Route::get('/', [BoardGameController::class, 'index']);
    Route::get('/{id}', [BoardGameController::class, 'show']);
    Route::post('/', [BoardGameController::class, 'store']);
    Route::put('/{id}', [BoardGameController::class, 'update']);
    Route::delete('/{id}', [BoardGameController::class, 'destroy']);
});


