<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetails;
use App\Models\User;
use App\Models\VehicleAllocation;
use App\Models\Vehicles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleAllocationController extends BaseController
{

    public function alloctionList(Request $request)
    {
        $this->setPageTitle('Vehicle');
        $vehicleAllocations = VehicleAllocation::all();
        // $darass = Vehicles::with(['carInoutTime', 'vehicleAllocation' => function ($q) {
        //     $q->where('is_active', 0);
        // $q->with(['vehicle' => function ($vq) {
        //     $vq->with(['carInoutTime' => function ($cvq) {
        //         $cvq->whereNotNull('hours_type');
        //     }]);
        // }]);
        // }])->get();
        $dateString = '2024-04-05';
        $date = Carbon::parse($dateString);

        // Extract the month and year from the date
        $month = $date->month; // 4 for April
        $year = $date->year; // 2024

        // Build the start and end dates for the specified month
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // $darass = VehicleAllocation::with(['vehicle','carInoutTime'])->where('allocation',0)->where('is_active', 0)->get();
        // $darass = VehicleAllocation::with(['vehicle', 'carInoutTime'])->where('allocation', 0)->where('is_active', 0)->get();
        // ->selectRaw('MONTH(car_date) as month')
        // ->groupBy('month');

        // => function ($q) {
        // $q->selectRaw('MONTH(car_date) as month')
        // $q->whereNotNull('car_date');
        // $q->whereBetween('car_date', [$startDate, $endDate]);
        // }

        $darass = VehicleAllocation::with(['vehicle', 'carInoutTime'])->where('allocation', 0)->where('is_active', 0)->get();

        // Initialize variables for sum and count
        $totalHours = 0;
        $hoursTypeCounts = [];

        // Loop through each VehicleAllocation record
        foreach ($darass as $allocation) {
            // dd($allocation->carInoutTime);
            // Loop through each carInoutTime related to the allocation
            foreach ($allocation->carInoutTime as $carTime) {
                // Add total_hours to the sum
                $fdsa=collect($carTime);
                // dd($fdsa);

                $totalHours += Carbon::parse($carTime->total_hours)->timestamp;

                // Count occurrences of hours_type
                $hoursType = $carTime->hours_type;
                if (!isset($hoursTypeCounts[$hoursType])) {
                    $hoursTypeCounts[$hoursType] = 1;
                } else {
                    $hoursTypeCounts[$hoursType]++;
                }
            }
        }

        // Convert totalHours back to a CarbonInterval object
        $totalHours = Carbon::createFromTimestamp($totalHours);

        // Output total hours and hours type counts
        echo "Total Hours: " . $totalHours->format('H:i:s') . "\n";
        echo "Hours Type Counts: \n";
        print_r($hoursTypeCounts);

        // dd($darass->toArray(), $hoursTypeCounts, $totalHours->format('H:i:s'));
        return view('admin.vehicleAlloction.index', compact('vehicleAllocations'));
    }

    public function addAlloction(Request $request)
    {
        $request->validate([
            'client' => 'required|integer',
            'vehical' => 'required|integer', // Corrected the spelling here
            'allocation' => 'required|integer',
            'working_hrs' => 'required|integer|min:1|max:24',
            'allocation_date' => 'required|date',
            'price' => 'required|numeric'
        ]);

        DB::beginTransaction();
        $date = Carbon::now();
        $due_payment = $request->price - $request->advance_payment;
        try {
            $isExitesId = VehicleAllocation::where('vehicles_id', $request->vehical)->where('is_active', 0)->orderBy('id', 'desc')->first();

            //   dd($isExitesId);
            if (!$isExitesId) {
                $record = VehicleAllocation::create([
                    'clients_id' => $request->client,
                    'vehicles_id' => $request->vehical,
                    'user_id' => auth()->user()->id,
                    'allocation' => $request->allocation,
                    'working_hrs' => $request->working_hrs,
                    'allocation_date' => $request->allocation_date,
                    // 'price' => $request->price
                ]);
                if ($request->allocation == 0) {
                    $allocation_date = Carbon::parse($request->allocation_date);
                    $endOfMonth = $allocation_date->copy()->endOfMonth();
                    $totalDays = $allocation_date->diffInDays($endOfMonth);
                    $perDayPrice = $request->price / $totalDays;
                    // dd($totalDays, $perDayPrice );
                } else {
                    $perDayPrice = null;
                }

                $isCreatedPayment = PaymentDetails::create([
                    'vehicles_id' => $request->vehical,
                    'date' => $date,
                    'total_price' => $request->price,
                    'advance_payment' => $request->advance_payment ?? '',
                    'due_payment' => $due_payment ?? '',
                    'type' => $request->working_hrs,
                    'per_day_price' => $perDayPrice ?? ''
                ]);
                if ($record) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Client Created Successfully', route('vehicle-allocation.list'));
                }
            } else {
                return $this->responseJson(true, 200, 'This Vehicel Already Allocated', route('vehicle-allocation.list'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong', route('client.list'));
        }
    }
}
