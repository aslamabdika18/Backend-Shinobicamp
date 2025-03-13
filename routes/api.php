<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    CategorycampController,
    TeamController,
    UserController,
    CoachController,
    EventController,
    PaymentController,
    RegistereventController
};
use App\Http\Controllers\Auth\{
    RegisteredUserController,
    AuthenticatedSessionController
};

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest')
        ->name('auth.register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest')
        ->name('auth.login');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:sanctum')
        ->name('auth.logout');
});

// Protected routes yang membutuhkan authentication
Route::middleware('auth:sanctum')->group(function () {

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('events', EventController::class)->except(['index', 'show']);
        Route::apiResource('coachprofiles', CoachController::class)->except(['index', 'show']);
        Route::apiResource('teams', TeamController::class)->except(['index', 'show']);
        Route::apiResource('registerevents', RegistereventController::class)->except(['index', 'show']);
        Route::apiResource('payments', PaymentController::class)->except(['index', 'show']);
        Route::apiResource('categorycamps', CategorycampController::class)->except(['index', 'show']);
    });

    // Routes untuk admin dan coach
    Route::middleware('role:admin,coach')->group(function () {
        Route::apiResource('events', EventController::class)->only(['index', 'show']);
    });
});
