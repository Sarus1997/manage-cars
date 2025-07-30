<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CustomAuth;
use App\Http\Middleware\AdminOnly;

Route::get('/', fn() => redirect('/login'));

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/reset-password', [AuthController::class, 'showResetForm']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['web', CustomAuth::class])->group(function () {
  Route::get('/dashboard', fn() => view('index'));

  // Car Management
  Route::get('/cars', [CarController::class, 'index']);
  Route::post('/cars/store', [CarController::class, 'store']);
  Route::put('/cars/update/{id}', [CarController::class, 'update']);
  Route::delete('/cars/delete/{id}', [CarController::class, 'delete']);

  // Loan Management
  Route::get('/loan', [LoanController::class, 'index']);
  Route::post('/loan/calculate', [LoanController::class, 'calculate'])->name('loan.calculate');

  // Admin Routes
  Route::middleware(AdminOnly::class)->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index']);
    Route::post('/admin/users/reset/{id}', [AdminController::class, 'reset']);
    Route::post('/admin/users/block/{id}', [AdminController::class, 'block']);
  });
});
