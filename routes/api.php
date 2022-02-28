<?php

use App\Http\Controllers\API\CostumerController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\SalesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('item', [ItemController::class, 'index']);

Route::apiResource('item', ItemController::class);

Route::apiResource('costumer', CostumerController::class);

Route::apiResource('sale', SalesController::class);
