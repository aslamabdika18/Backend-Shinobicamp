<?php

use App\Http\Controllers\API\CategorycampController;
use App\Models\Team;
use App\Models\Registerevent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CoachController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Authentication Routes
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');

// Protected routes yang membutuhkan authentication
Route::middleware(['auth:sanctum'])->group(function () {

    // Routes yang hanya bisa diakses admin
    Route::middleware(['role:admin'])->group(function () {
        Route::apiResource('users', UserController::class);
        // Route untuk CRUD khusus admin
        Route::apiResource('events', EventController::class)->except(['index', 'show']);
        Route::apiResource('coachprofiles', CoachController::class)->except(['index', 'show']);
        Route::apiResource('teams', TeamController::class)->except(['index', 'show']);
        Route::apiResource('registerevents', Registerevent::class)->except(['index', 'show']);
        Route::apiResource('payments', PaymentController::class)->except(['index', 'show']);
        Route::apiResource('categorycamps', CategorycampController::class)->except(['index', 'show']);
    });

    // Routes yang bisa diakses admin dan coach
    Route::middleware(['role:admin,coach'])->group(function () {

        // Route untuk melihat event (index & show) bisa diakses admin dan coach
        Route::apiResource('events', EventController::class)->only(['index', 'show']);
    });
});
