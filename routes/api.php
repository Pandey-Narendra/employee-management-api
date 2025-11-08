<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
// use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here you can register API routes for your application. These routes
| are loaded by the RouteServiceProvider and all will be assigned
| to the "api" middleware group. Make something great!
|
*/

// Public Routes

Route::get('auth/test', function() {
    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully.',
    ], 200);
});

// Route::post('auth/register', function() {
//     return response()->json([
//         'status' => true,
//         'message' => 'Logged out successfully.',
//     ], 200);
// });

// Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

