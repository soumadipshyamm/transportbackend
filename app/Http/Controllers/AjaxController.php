<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clients;
use App\Models\Vendors;
use App\Models\Expenses;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\carInoutTime;
use App\Models\Helper;
use App\Models\VehicleAllocation;
use App\View\Components\modals\car;
use Faker\Core\Version;

class AjaxController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function getClient(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'clients');
            // dd($id);
            $fetchIdExitOrNot = Clients::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Client found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }
    public function getHelper(Request $request)
    {
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'helpers');
            $fetchIdExitOrNot = Helper::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Helper found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getVendor(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'Vendors');
            // dd($id);
            $fetchIdExitOrNot = Vendors::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Vendor found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getVehicle(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'vehicles');
            // dd($id);
            $fetchIdExitOrNot = Vehicles::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Vehicles found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getExpenses(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'expenses');
            // dd($id);
            $fetchIdExitOrNot = Expenses::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Expenses found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getSupervisor(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'users');
            // dd($id);
            $fetchIdExitOrNot = User::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Supervisor found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getClientAlloction(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'users');
            // dd($id);
            $fetchIdExitOrNot = User::with('clientsAlloction')->where('id', $id)->first();
            // dd($fetchIdExitOrNot->toArray());
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Supervisor found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getCarInOutTime(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'car_inout_times');
            // dd($id);
            $fetchIdExitOrNot = carInoutTime::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Car Time found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }

    public function getQrGenerateDetails(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = uuidtoid($request->uuid, 'vehicles');
            // dd($id);
            $fetchIdExitOrNot = Vehicles::where('id', $id)->first();
            if ($fetchIdExitOrNot) {
                return $this->responseJson(true, 200, 'Vehical Details found successfully', $fetchIdExitOrNot);
            }
            return $this->responseJson(false, 200, 'No data found');
        }
        abort(405);
    }
    // public function setStatus(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $table = $request->find;
    //         $data = $request->value;
    //         //  $id = uuidtoid($request->uuid, $table);
    //         switch ($table) {
    //  case 'users':
    //      $id = uuidtoid($request->uuid, $table);
    //      $data = $this->userService->updateUser($request->only('is_active'), $id);
    //      $message = 'User Status updated';
    //      break;

    //  default:
    //      return $this->responseJson(false, 200, 'Something Wrong Happened');
    // }

    //  if ($data) {
    //      return $this->responseJson(true, 200, $message);
    //  } else {
    //      return $this->responseJson(false, 200, 'Something Wrong Happened');
    //  }
    //     }
    //     abort(405);
    // }

    public function deleteData(Request $request)
    {
        if ($request->ajax()) {
            $table = $request->find;
            switch ($table) {
                case 'clients':
                    // return "clients";
                    $id = uuidtoid($request->uuid, $table);
                    // dd(Clients::where('id', $id)->delete());
                    $data = Clients::where('id', $id)->delete();
                    $message = 'User Deleted';
                    break;
                case 'vendors':
                    // return "clients";
                    $id = uuidtoid($request->uuid, $table);
                    // dd(Clients::where('id', $id)->delete());
                    $data = Vendors::where('id', $id)->delete();
                    $message = 'Vendor Deleted';
                    break;
                case 'vehicles':
                    // return "clients";
                    $id = uuidtoid($request->uuid, $table);
                    // dd(Clients::where('id', $id)->delete());
                    $data = Vehicles::where('id', $id)->delete();
                    $message = 'Vehicle Deleted';
                    break;

                case 'expenses':
                    // return "clients";
                    $id = uuidtoid($request->uuid, $table);
                    $data = Expenses::where('id', $id)->delete();
                    $message = 'Expenses Deleted';
                    break;
                case 'users':
                    // return "clients";
                    $id = uuidtoid($request->uuid, $table);
                    $data = User::where('id', $id)->delete();
                    $message = 'Users Deleted';
                    break;
                case 'vehicle_allocations':
                    $id = $request->uuid;
                    $data = VehicleAllocation::where('id', $id)->delete();
                    $message = 'Vehicle Allocation Deleted';
                    break;
                case 'helpers':
                    $id = uuidtoid($request->uuid, $table);
                    $data = Helper::where('id', $id)->delete();
                    $message = 'Helper Deleted';
                    break;
                    // case 'car_inout_times':
                    //     // return "clients";
                    //     $id = uuidtoid($request->uuid, $table);
                    //     // dd(Clients::where('id', $id)->delete());
                    //     $data = carInoutTime::where('id', $id)->delete();
                    //     $message = 'Users Deleted';
                    //     break;
            }
            if (isset($data)) {
                return $this->responseJson(true, 200, $message);
            } else {
                return $this->responseJson(false, 500, 'Something Wrong Happened');
            }
        } else {
            abort(405);
        }
    }
}
