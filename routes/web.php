<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardGameController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Use the 'create' method from the BoardGameController to show the form
Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/boardgames/add', [BoardGameController::class, 'create'])->name('boardgames.add');

// Use the 'store' method from the BoardGameController to handle form submission
Route::post('/boardgames', [BoardGameController::class, 'store'])->name('boardgames.store');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');