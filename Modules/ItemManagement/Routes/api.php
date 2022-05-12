<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\ItemManagement\Http\Controllers\ItemSellingController;
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

Route::middleware('auth:api')->get('/itemselling', function (Request $request) {
    return $request->user();
});


Route::post('additem', [ItemSellingController::class, 'store']);
Route::get('Itemes', [ItemSellingController::class, 'index']);
Route::put('updateItem/{id}', [ItemSellingController::class, 'update']);
Route::delete('deleteItem/{id}', [ItemSellingController::class, 'destroy']);