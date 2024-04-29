<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommonController;
use App\Http\Controllers\API\QrcodesController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    // Route::post('/generate-new-token','generateToken')->name('generate.new.token');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('update-password', [AuthController::class, 'updatePassword']);

    Route::post('list', [CommonController::class, 'clientList']);
    Route::post('superviser-clent-list', [CommonController::class, 'superviserWiseClientList']);
    Route::post('vehiclelist', [CommonController::class, 'vehiclelist']);
    Route::post('inoutList', [CommonController::class, 'clientVehicleInOutTimeList']);
    Route::post('vehicle-wise-inoutList', [CommonController::class, 'vehicleWiseInOutTimeList']);
    Route::post('add-expences', [CommonController::class, 'addExpences']);
    Route::post('list-expences', [CommonController::class, 'listExpences']);

    Route::get('list-helper', [CommonController::class, 'listHelper']);

    // Route::post('get-show-car-in-out-time/{uuid}', [QrcodesController::class, 'getCarInOutTime']);
    Route::post('get-show-car-in-out-time-uuid', [QrcodesController::class, 'getCarInOutTimeUuid']);
    Route::post('get-show-car-in-out-time-manually', [QrcodesController::class, 'getCarInOutTimeManually']);
    Route::post('car-report', [QrcodesController::class, 'carReport']);
    Route::post('car-report-list', [QrcodesController::class, 'carReportList']);

    Route::post('get-file', [QrcodesController::class, 'fileUpload']);
    Route::post('get-profile-list', [AuthController::class, 'getProfileUpdateList']);
    Route::post('get-profile-update', [AuthController::class, 'getProfileUpdate']);
    Route::post('get-profile-update-image', [AuthController::class, 'getProfileUpdateImg']);



});
