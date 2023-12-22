<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardGameController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AdminController;

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

Route::get('/threads', [ForumController::class, 'getAllThreads']);
Route::get('/threads/{threadId}/comments',[ForumController::class,'getCommentsForThreads']);


Route::middleware('auth:sanctum')->group(function () {
  Route::post('/threads', [ForumController::class, 'createThread']);
  Route::get('/threads/{id}', [ForumController::class, 'getThread']);
  Route::post('/threads', [ForumController::class, 'createThread']);
  Route::post('/threads/{threadId}/comments',[ForumController::class,'createComment']);
  Route::post('/threads/{threadId}/upvote',[ForumController::class,'upVote']);
  Route::get('/threads/{threadId}/upvote',[ForumController::class,'upVote']);
  Route::delete('/threads/{threadId}/upvote',[ForumController::class,'removeUpvote']);
});


    
Route::prefix('/board-games')->group(function () {
  Route::get('/', [BoardGameController::class, 'index']);
  Route::get('/{id}', [BoardGameController::class, 'show']);
  Route::post('/', [BoardGameController::class, 'store']);
  Route::put('/{id}', [BoardGameController::class, 'update']);
  Route::delete('/{id}', [BoardGameController::class, 'destroy']);
});




Route::apiResource('/reservations', ReservationController::class);