<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
    return response()->json([
        'status' => true,
        'message' => 'Logged out successfully.',
    ], 200);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
