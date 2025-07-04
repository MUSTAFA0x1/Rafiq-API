<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StepsController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\Auth\SocialAuthController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('/redirect/google', [SocialAuthController::class, 'redirectToGoogle']);
    Route::get('/callback/google', [SocialAuthController::class, 'handleGoogleCallback']);

    Route::middleware('auth.jwt')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::put('profile', [AuthController::class, 'updateProfile']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });

    //=================================================================================================

    Route::middleware('auth.jwt')->group(function () {
        Route::get('tasks', [TaskController::class, 'index']);
        Route::post('tasks', [TaskController::class, 'store']);
        Route::get('tasks/{id}', [TaskController::class, 'show']);
        Route::put('tasks/{id}', [TaskController::class, 'update']);
        Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    });

    //=================================================================================================

    Route::middleware('auth.jwt')->group(function () {
        Route::get('step-track', [StepsController::class, 'index']);
        Route::post('step-track', [StepsController::class, 'store']);
        Route::get('step-track/{id}', [StepsController::class, 'show']);
        Route::put('step-track/{id}', [StepsController::class, 'update']);
        Route::delete('step-track/{id}', [StepsController::class, 'destroy']);
    });

    //=================================================================================================

    Route::middleware('auth.jwt')->group(function () {
        Route::get('water-track', [WaterController::class, 'index']);
        Route::post('water-track', [WaterController::class, 'store']);
        Route::get('water-track/{id}', [WaterController::class, 'show']);
        Route::put('water-track/{id}', [WaterController::class, 'update']);
        Route::delete('water-track/{id}', [WaterController::class, 'destroy']);
    });

    //=================================================================================================

    Route::middleware('auth.jwt')->group(function () {
        Route::get('prayer', [PrayerController::class, 'index']);
        Route::post('prayer', [PrayerController::class, 'store']);
        Route::get('prayer/{id}', [PrayerController::class, 'show']);
        Route::put('prayer/{id}', [PrayerController::class, 'update']);
        Route::delete('prayer/{id}', [PrayerController::class, 'destroy']);
    });

    //=================================================================================================

    Route::middleware('auth.jwt')->group(function(){
        Route::get('/user/data',[UserDataController::class,'fetchAllUserData']);

        Route::get('/user/magic-points',[UserDataController::class,'fetchMagicPoints']);
        Route::get('/user/magic-ranking',[UserDataController::class,'fetchMagicRanking']);

        Route::get('/user/weekly-steps',[UserDataController::class,'fetchWeeklyStep']);
        Route::get('/user/weekly-water',[UserDataController::class,'fetchWeeklyWater']);

        Route::get('/user/tasks-sum',[UserDataController::class,'fetchTasksSummary']);

        Route::get('/user/fard-prayer',[UserDataController::class,'fetchFardPrayers']);
        Route::get('/user/prayers-pct',[UserDataController::class,'fetchPrayerPct']);
        Route::get('/user/nawafil',[UserDataController::class,'fetchNawafilStreak']);

    });

});
