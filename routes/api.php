<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
// use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;

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
        'message' => 'API is working.',
    ], 200);
});

// Route::post('auth/register', function() {
//     return response()->json([
//         'status' => true,
//         'message' => 'Logged out successfully.',
//     ], 200);
// });

// Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::prefix('auth')->middleware('throttle:10,1')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::get('/test-departments', [\App\Http\Controllers\Api\DepartmentController::class, 'index1']);

// Protected Routes (requires auth + token not expired)
Route::middleware(['auth:sanctum', 'token.not.expired'])->group(function () {
    
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Departments CRUD
    Route::prefix('departments')->group(function () {
        Route::get('/', [DepartmentController::class, 'index']);
        Route::post('/', [DepartmentController::class, 'store']);
        Route::get('{id}', [DepartmentController::class, 'show']);        // id = encrypted
        Route::put('{id}', [DepartmentController::class, 'update']);      // id = encrypted
        Route::delete('{id}', [DepartmentController::class, 'destroy']);  // id = encrypted
    });

    // Employees CRUD
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::post('/', [EmployeeController::class, 'store']);
        Route::get('{id}', [EmployeeController::class, 'show']);         // id = encrypted
        Route::put('{id}', [EmployeeController::class, 'update']);       // id = encrypted
        Route::delete('{id}', [EmployeeController::class, 'destroy']);   // id = encrypted
    });
});

