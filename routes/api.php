<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// routes/web.php

// Route::get('/csrf-token', function() {
//     session_start();
//     return response()->json(['csrf_token' => csrf_token()]);
// });


Route::resource('shipping', 'App\Http\Controllers\ShippingController');

Route::resource('billing', 'App\Http\Controllers\BillingController');
