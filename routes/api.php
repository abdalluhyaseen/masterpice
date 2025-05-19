<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FieldController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\SportTypeController;
use App\Http\Controllers\Api\FieldTypeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'App\Http\Controllers\UserController@login');
Route::post('/signup', 'App\Http\Controllers\UserController@signup');






// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Fields Routes
Route::apiResource('fields', FieldController::class);

// Bookings Routes
Route::apiResource('bookings', BookingController::class);

// Additional custom routes
Route::get('/fields/available', [FieldController::class, 'availableFields']);
Route::get('/fields/sport/{sportTypeId}', [FieldController::class, 'fieldsBySportType']);

Route::group(['prefix' => 'sport-types'], function () {
    Route::get('/', [SportTypeController::class, 'index']);
    Route::post('/', [SportTypeController::class, 'store']);
    Route::get('/{id}', [SportTypeController::class, 'show']);
    Route::put('/{id}', [SportTypeController::class, 'update']);
    Route::delete('/{id}', [SportTypeController::class, 'destroy']);
    Route::post('/{id}/restore', [SportTypeController::class, 'restore']);
});


Route::get('/fields/{field}/slots', [FieldController::class, 'availableSlots']);

Route::apiResource('field-types', FieldTypeController::class);
