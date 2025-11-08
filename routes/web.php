<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return response()->json([
        'status' => true,
        'message' => 'API is working.',
    ], 200);
});

// Route::get('/', function () {
//     return view('welcome');
// });
