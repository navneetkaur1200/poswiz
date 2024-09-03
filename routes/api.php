<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\SaleRecordController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', [HomeController::class, 'test']);
Route::prefix('store')->group(function () {
    Route::get('{id}', [HomeController::class, 'getStoreById']);
});


Route::middleware('apikey')->prefix('sale-record')->group(function () {
    Route::get('day-total', [SaleRecordController::class, 'saleRecordDayTotal']);
});