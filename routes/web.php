<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\CategoryController;

Route::get('/csrf-token', function() {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/import-csv', [CategoryController::class, 'importCsv'])->name('importCsv');
