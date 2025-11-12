<?php

//use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});
//register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//videos
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');

Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');

//delete
Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');


//user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/upload', [VideoController::class, 'create'])->name('upload');
    Route::post('/upload', [VideoController::class, 'store']);
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
});


//admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/videos', [AdminController::class, 'videos'])->name('admin.videos');
    Route::post('/videos/{id}/approve', [AdminController::class, 'approve'])->name('admin.videos.approve');
    Route::post('/videos/{id}/delete', [AdminController::class, 'deleteVideo'])->name('admin.videos.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});
