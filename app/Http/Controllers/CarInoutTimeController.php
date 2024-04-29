<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\carInoutTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\VehicleAllocation;

class CarInoutTimeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Car In/Out Time');
        $carInoutTimes = carInoutTime::with('clients', 'vehical')->get();
        // dd($carInoutTimes);
        return view('admin.carTimeReport.index', compact('carInoutTimes'));
    }
    public function add(Request $request)
    {
        $request->validate([
            "vehicles_id" => 'required',
            "clients_id" => 'required',
            "in_time" => 'required',
            "out_time" => 'required',
            "helper" => 'required',
        ]);
        DB::beginTransaction();

        $start  = new Carbon($request->in_time);
        $end    = new Carbon($request->out_time);
        $diff = $start->diff($end); // Format the difference
        $totalHrs = $diff->format('%h:%i');
        try {
            $findAllocationId = VehicleAllocation::where('vehicles_id', $request->vehicles_id)->where('is_active', 0)->orderBy('id', 'desc')->first();
            $isClientCreated = carInoutTime::create([
                'uuid' => Str::uuid(),
                'car_date' => Carbon::now(),
                'users_id' => auth()->user()->id,
                'vehicles_id' => $request->vehicles_id,
                'clients_id' => $request->clients_id,
                'in_time' => $request->in_time,
                'out_time' => $request->out_time,
                'helper_id' => $request->helper,
                'hours_type' => $request->hours_type,
                'total_hours' => $totalHrs,
                'vehicle_allocations_id' => $findAllocationId->id
            ]);
            if ($isClientCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Car Time added Successfully');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong');
        }
    }

    public function edit(Request $request, $uuid)
    {
        if ($request->post()) {
            DB::beginTransaction();
            $start  = new Carbon($request->in_time);
            $end    = new Carbon($request->out_time);
            $diff = $start->diff($end); // Format the difference
            $totalHrs = $diff->format('%h:%i');
            try {
                $id = uuidtoid($uuid, 'car_inout_times');
                $isClientUpdated = carInoutTime::where('id', $id)->update([
                    'users_id' => auth()->user()->id,
                    'car_date' => Carbon::now(),
                    'vehicles_id' => $request->vehicles_id,
                    'clients_id' => $request->clients_id,
                    'in_time' => $request->in_time,
                    'out_time' => $request->out_time,
                    'helper_id' => $request->helper,
                    'total_hours' => $totalHrs,
                ]);
                if ($isClientUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Car Time updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }
}
