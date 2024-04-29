<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use App\Models\Vehicles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\User;

class VehiclesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Vehicles');
        $vehicales = Vehicles::with('vendors')->get();
        return view('admin.vehicle.index', compact('vehicales'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     "type" => "required",
        //     "car_number" => "required",
        // ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            if ($request->has('rc_no')) {
                $img = carImageUpload($request->rc_no);
            }
            $isClientCreated = Vehicles::create([
                'uuid' => Str::uuid(),
                'qr_code' => uniqid(),
                'type' => $request->type ?? '',
                'car_number' => $request->car_number,
                'rc_no' => $img ?? '',
                'car_price' => $request->car_price,
                'vendor_id' => $request->vendor_id
            ]);
            // dd($isClientCreated);
            if ($isClientCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Vehicle Created Successfully');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $uuid)
    {
        if ($request->post()) {
            DB::beginTransaction();
            try {
                $id = uuidtoid($uuid, 'vehicles');
                $isVehiclesUpdated = Vehicles::where('id', $id)->update([
                    'type' => $request->type,
                    'car_number' => $request->car_number,
                    'vendor_id' => $request->vendor_id,
                    'car_price' => $request->car_price,
                ]);
                if ($isVehiclesUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Vehicles updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }

    public function alloction(Request $request)
    {
        $this->setPageTitle('Vehicle');
        // return "kjhgfds";
        $clientsAlloctions = User::with('clientsAlloction')->where('type', 1)->get();
        // dd($clientsAlloctions->toArray());
        return view('admin.vehicleAlloction.index', compact('clientsAlloctions'));
    }
}
