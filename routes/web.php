<?php

// use App\Http\Controllers\Auth\LoginController;

// use App\Http\Controllers\HelperController;

// use App\Http\Controllers\PaymentDetailsController;
// use App\Http\Controllers\ReportingController;
use App\Http\Controllers\testController;
// use App\Http\Controllers\VehicleAllocationController;
use App\Models\Reporting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(HomeController::class)->prefix('dashboard')->as('dashboard.')->group(function () {
        // Route::get('logout','logout')->name('logout');
        Route::get('/', 'index')->name('list');
        Route::POST('password-update', 'passwordUpdate')->name('passwordUpdate');
    });

    Route::controller(ClientsController::class)->prefix('client')->as('client.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add-client', 'add')->name('add');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
        Route::get('/alloction', 'alloction')->name('alloction');
        Route::Post('/alloction', 'addAlloction')->name('addAlloction');
        Route::Post('/edit-alloction/{uuid}', 'editAlloction')->name('editAlloction');
    });
    Route::controller(HelperController::class)->prefix('helper')->as('helper.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add-helper', 'add')->name('add');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
        // Route::get('/alloction', 'alloction')->name('alloction');
        // Route::Post('/alloction', 'addAlloction')->name('addAlloction');
        // Route::Post('/edit-alloction/{uuid}', 'editAlloction')->name('editAlloction');
    });
    Route::controller(VehiclesController::class)->prefix('vehicle')->as('vehicle.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add-vendor', 'add')->name('add');
        // Route::match(['get', 'post'], '/alloction', 'alloction')->name('alloction');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
    });

    Route::controller(VehicleAllocationController::class)->prefix('vehicle-allocation')->as('vehicle-allocation.')->group(function () {
        Route::get('/', 'alloctionList')->name('list');
        Route::match(['get', 'post'], '/alloction', 'addAlloction')->name('addAlloction');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
    });

    Route::controller(VendorsController::class)->prefix('vendor')->as('vendor.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add-vendor', 'add')->name('add');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
    });
    Route::controller(SupervisorsController::class)->prefix('supervisor')->as('supervisor.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('add-supervisor', 'add')->name('add');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
    });

    Route::controller(ExpensesController::class)->prefix('expense')->as('expense.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add-expense', 'add')->name('add');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
    });

    Route::controller(CarReportsController::class)->prefix('report')->as('report.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::get('searching', 'searching')->name('searching');
        Route::post('excel/{type}', 'exportData')->name('excel');

        Route::get('car-issue-list', 'carIssueList')->name('carIssueList');
    });

    Route::controller(ReportingController::class)->prefix('reporting')->as('reporting.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::get('searching', 'searching')->name('searching');
        Route::post('excel/{type}', 'exportData')->name('excel');
    });
    Route::controller(PaymentDetailsController::class)->prefix('payment_details')->as('payment_details.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add', 'add')->name('add');
    });


    Route::controller(CarInoutTimeController::class)->prefix('carTime')->as('carTime.')->group(function () {
        Route::get('/', 'index')->name('list');
        Route::post('/add-expense', 'add')->name('add');
        Route::post('/edit/{uuid}', 'edit')->name('edit');
    });
    Route::controller(UserRolePermissionController::class)->prefix('rolePermission')->as('rolePermission.')->group(function () {
        Route::get('/user-role', 'userAddRole')->name('userAddRole');
        Route::post('/add-user-role', 'addUserRole')->name('addUserRole');

        Route::post('/user-permissions', 'permissionManagement')->name('permissionManagement');
        Route::post('/add-user-permissions', 'addPermissionManagement')->name('addPermissionManagement');
        Route::post('/fetch-user-permissions', 'featchRolePermission')->name('featchRolePermission');

        // Route::get('/manage-role-permissions', 'addPermission')->name('addPermission');
        // Route::post('/add-role-permission', 'addRolePermission')->name('addRolePermission');
        // Route::get('/featch-role-permission', 'featchRolePermission')->name('featchRolePermission');

        // Route::get('/user-management', 'userManagement')->name('userManagement');
    });
});


Route::get('/test', [testController::class, 'index'])->name('test');
