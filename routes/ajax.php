<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Ajax Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ajax routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "ajax" middleware group. Make something great!
|
*/
Route:: as ('ajax.')->middleware(['auth'])->group(function () {
    Route::controller(AjaxController::class)->group(function () {
        Route::group(['as' => 'get.'], function () {
            Route::get('/getClient/{uuid}', 'getClient')->name('client');
            Route::get('/getHelper/{uuid}', 'getHelper')->name('helper');
            Route::get('/getVendor/{uuid}', 'getVendor')->name('vendor');
            Route::get('/getVehicle/{uuid}', 'getVehicle')->name('vehicle');
            Route::get('/getExpenses/{uuid}', 'getExpenses')->name('expenses');
            Route::get('/getSupervisor/{uuid}', 'getSupervisor')->name('supervisor');
            Route::get('/getClientAlloction/{uuid}', 'getClientAlloction')->name('clientAlloction');
            Route::get('/getCarInOutTime/{uuid}', 'getCarInOutTime')->name('CarInOutTime');
            Route::get('/getQrGenerateDetails/{uuid}', 'getQrGenerateDetails')->name('qrGenerateDetails');
        });

        // Route::group(['as' = > 'update.'], function () {
        //     Route::match(['put', 'post'], '/updateStatus', 'setStatus')->name('status');
        //     // Route::match(['put', 'post'], '/update/settings', 'updateSettings')->name('settings');
        // });

        Route::group(['as' => 'delete.'], function () {
            Route::delete('/deleteData', 'deleteData')->name('data');
        });
    });
});
