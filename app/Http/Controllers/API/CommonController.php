<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Clients;
use App\Models\Expenses;
use App\Models\Vehicles;
use Illuminate\Support\Str;
use App\Models\carInoutTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Helper;
use Illuminate\Support\Facades\Validator;

class CommonController extends BaseController
{
    public function clientList()
    {
        $client = Clients::get();
        return $this->responseJson(true, 200, 'Client Data Found', $client);
    }
    public function superviserWiseClientList(Request $request)
    {
        // dd($request->all());
        $supervisorId = $request->superviserId;
        // return $supervisorId;
        // return User::with('clientsAlloction')->has('clientsAlloction')->get();
        $supervisorWiseClient = User::with([
            'clientsAlloction' => function ($q) use ($supervisorId) {
                $q->where('user_id', $supervisorId);
            }
        ])->has('clientsAlloction')->get();

        //    return $supervisorWiseClient;

        return $this->responseJson(true, 200, 'Client Data Found', $supervisorWiseClient);
    }
    public function vehiclelist()
    {
        // return "test";
        $vehicle = Vehicles::all();
        return $this->responseJson(true, 200, 'Vehicle Data Found', $vehicle);
    }

    public function clientVehicleInOutTimeList()
    {
        $vehicleInOutTime = carInoutTime::with('clients', 'vehical')->get();
        return $this->responseJson(true, 200, 'Car In-Time and Out-Time Data Found', $vehicleInOutTime);
        // dd($vehicleInOutTime);
    }

    // public function vehicleWiseInOutTimeList(Request $request)
    // {
    //     // dd($request->all());
    //     $fromDate=$request->fromDate;
    //     $clientWiseVehicleInOutTime = carInoutTime::with('clients', 'vehical')->where('clients_id', $request->id)
    //     ->when($fromDate, function ($q) use ($fromDate) {
    //         return $q->whereDate('car_date', '>=', $fromDate);
    //     })
    //     ->get();
    //     return $clientWiseVehicleInOutTime;
    //     if (count($clientWiseVehicleInOutTime) != 0) {
    //         return $this->responseJson(true, 200, 'Client Wise Vehicle Data Found', $clientWiseVehicleInOutTime);
    //     } else {
    //         return $this->responseJson(true, 200, 'Client Wise Vehicle Data Not Found');
    //     }
    //     // dd($vehicleInOutTime->toArray());
    // }
    public function vehicleWiseInOutTimeList(Request $request)
    {
        // $fromDate=date_format($request->fromDate,'dd-MM-yyyy');
        // dd($fromDate);
        $fromDate = $request->fromDate;
        $clients_id = $request->id;
        $data['vehicalList'] = carInoutTime::with('clients', 'vehical')->when($clients_id, function ($q) use ($clients_id) {
            return $q->where('clients_id', $clients_id);
        })->when($fromDate, function ($q) use ($fromDate) {
            return $q->whereDate('car_date', '=', $fromDate);
        })
            ->get();
        $data['url'] = url('/storage/carInOut');
        // return $data;
        if (count($data) != 0) {
            if (count($data) != 0) {
                return $this->responseJson(true, 200, 'Vehicle Data Found', $data);
            } else {
                return $this->responseJson(true, 200, 'Vehicle Data Not Found');
            }
        } else {
            return $this->responseJson(true, 200, ' Vehicle Data Not Found');
        }
        // dd($vehicleInOutTime->toArray());
    }


    public function listExpences(Request $request)
    {
        $expenses = Expenses::get();
        return $this->responseJson(true, 200, 'Expenses Data Found', $expenses);
    }
    public function addExpences(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "driver_name" => "required",
            "date" => "required",
            "expense_amount" => "required",
            "purposes" => "required",
            'in_time' => "required",
            'out_time' => "required",
            'meter' => "required",
            'vehicles_id' => "required"
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        DB::beginTransaction();
        try {
            // dd($request->all());
            $isExpensesCreated = Expenses::create([
                'uuid' => Str::uuid(),
                'driver_name' => $request->driver_name,
                'date' => $request->date,
                'expense_amount' => $request->expense_amount,
                'purposes' => $request->purposes,
                'in_time' => $request->in_time,
                'out_time' => $request->out_time,
                'meter' => $request->meter,
                'vehicles_id' => $request->vehicles_id,
            ]);
            // dd($isExpensesCreated);
            if ($isExpensesCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Expenses Created Successfully', $isExpensesCreated);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong');
        }
    }

    public function listHelper()
    {
        $helper = Helper::all();
        return $this->responseJson(true, 200, 'Helper Data Found', $helper);
    }
}
