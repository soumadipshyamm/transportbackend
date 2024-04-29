<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\carInoutTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Reporting;
use Illuminate\Support\Facades\Validator;

class QrcodesController extends BaseController
{
    //
    // public function getCarInOutTime(Request $request, $uuid)
    // {
    //     $id = uuidtoid($uuid, 'vehicles');
    //     $status = $request->status;
    //     $time = $request->time;
    //     $users_id = auth()->user()->id;
    //     $filename = carImageUpload($request->file);
    //     // dd($filename);
    //     if (isset($id) && !empty($id)) {
    //         if ($status == 0) {
    //             DB::beginTransaction();
    //             try {
    //                 $isClientCreated = carInoutTime::create([
    //                     'uuid' => Str::uuid(),
    //                     'car_date' => Carbon::now(),
    //                     'users_id' => $users_id,
    //                     'vehicles_id' => $id,
    //                     'clients_id' => $request->clients_id,
    //                     'in_time' => $time,
    //                     'in_time_img' => $filename ?? ''
    //                 ]);
    //                 if ($isClientCreated) {
    //                     DB::commit();
    //                     return $this->responseJson(true, 200, 'Vehicle Data Found', $isClientCreated);
    //                 }
    //             } catch (\Exception $e) {
    //                 DB::rollBack();
    //                 logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
    //                 return $this->responseJson(false, 500, 'Something Went Wrong');
    //             }
    //         } else {
    //             $fetchInTimeId = carInoutTime::where('vehicles_id', $id)->where('out_time', NULL)->first()->id;
    //             DB::beginTransaction();
    //             try {
    //                 $isClientUpdated = carInoutTime::where('id', $fetchInTimeId)->update([
    //                     'out_time' => $time,
    //                     'out_time_img' => $filename ?? ''
    //                 ]);
    //                 if ($isClientUpdated) {
    //                     DB::commit();
    //                     return $this->responseJson(true, 200, 'Car Time updated successfully', $isClientUpdated);
    //                 }
    //             } catch (\Exception $e) {
    //                 DB::rollBack();
    //                 logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
    //                 return $this->responseJson(false, 500, 'Something went wrong');
    //             }
    //         }
    //     } else {
    //         return $this->responseJson(false, 500, 'Something went wrong');
    //     }
    // }
    public function getCarInOutTimeUuid(Request $request)
    {
        // dd($request->uuid);
        $validator = Validator::make($request->all(), [
            // 'file' => 'image|mimes:jpg,jpeg,png|max:2048',
            'helper' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        $uuid = $request->uuid;
        $id = uuidtoid($uuid, 'vehicles');
        $status = $request->status;
        $time = $request->time;
        $users_id = auth()->user()->id;
        // $filename = carImageUpload($request->file);
        if (isset($id) && !empty($id)) {
            if ($status == 0) {
                DB::beginTransaction();
                try {
                    $isClientCreated = carInoutTime::create([
                        'uuid' => Str::uuid(),
                        'car_date' => Carbon::now(),
                        'users_id' => $users_id,
                        'vehicles_id' => $id,
                        'clients_id' => $request->clients_id,
                        'in_time' => $time,
                        // 'in_time_img' => $filename,
                        'helper_id' => $request->helper,
                        'hours_type' => $request->hours_type ?? null,
                    ]);
                    if ($isClientCreated) {
                        DB::commit();
                        return $this->responseJson(true, 200, 'Vehicle Data Found', $isClientCreated);
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                    return $this->responseJson(false, 500, 'Something Went Wrong');
                }
            } else {
                $fetchInTimeId = carInoutTime::where('vehicles_id', $id)->where('out_time', NULL)->first()->id;
                DB::beginTransaction();
                try {
                    $isClientUpdated = carInoutTime::where('id', $fetchInTimeId)->update([
                        'out_time' => $time,
                        // 'out_time_img' => $filename,
                        'hours_type' => $request->hours_type ?? null,
                    ]);
                    if ($isClientUpdated) {
                        DB::commit();
                        return $this->responseJson(true, 200, 'Car Time updated successfully', $isClientUpdated);
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                    return $this->responseJson(false, 500, 'Something went wrong');
                }
            }
        } else {
            return $this->responseJson(false, 500, 'Something went wrong');
        }
    }
    /**
     * Take Photos after car in or out
     */
    public function fileUpload(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->responseJson(false, 422, $validator->errors()->all(), "");
        }
        $users_id = $request->users_id;
        $vehicles_id = $request->vehicles_id;
        $clients_id = $request->clients_id;
        $inoutId = $request->inoutId;
        $profileImg = carImageUpload($request->file);
        if ($request->type == '0') {
            DB::beginTransaction();
            try {
                $isUserProfileImgUpdated = carInoutTime::where([['id', $inoutId], ['vehicles_id', $vehicles_id], ['clients_id', $clients_id], ['users_id', $users_id]])->update([
                    "in_time_img" => $profileImg
                ]);
                if ($isUserProfileImgUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'In-Time Image Updated successfully', []);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
                return $this->responseJson(false, 500, $e->getMessage(), '');
            }
        } else {
            DB::beginTransaction();
            try {
                $isUserProfileImgUpdated = carInoutTime::where([['id', $inoutId], ['vehicles_id', $vehicles_id], ['clients_id', $clients_id], ['users_id', $users_id]])->update(["out_time_img" => $profileImg]);
                if ($isUserProfileImgUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Out-Time Image Updated successfully', []);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . 'on' . $e->getFile() . 'in' . $e->getLine());
                return $this->responseJson(false, 500, $e->getMessage(), '');
            }
        }
    }
    // *********************************************************
    // public function getCarInOutTimeManually(Request $request)
    // {
    //     $uuid = $request->uuid;
    //     $id = uuidtoid($uuid, 'vehicles');
    //     $status = $request->status;
    //     $time = $request->time;
    //     $users_id = auth()->user()->id;
    //     $filename = carImageUpload($request->file);
    //     if (isset($id) && !empty($id)) {
    //         if ($status == 0) {
    //             dd($request->all());
    //             DB::beginTransaction();
    //             try {
    //                 $isClientCreated = carInoutTime::create([
    //                     'uuid' => Str::uuid(),
    //                     'car_date' => Carbon::now(),
    //                     'users_id' => $users_id,
    //                     'vehicles_id' => $id,
    //                     'clients_id' => $request->clients_id,
    //                     'in_time' => $time,
    //                     'in_time_img' => $filename
    //                 ]);
    //                 if ($isClientCreated) {
    //                     DB::commit();
    //                     return $this->responseJson(true, 200, 'Vehicle Data Found', $isClientCreated);
    //                 }
    //             } catch (\Exception $e) {
    //                 DB::rollBack();
    //                 logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
    //                 return $this->responseJson(false, 500, 'Something Went Wrong');
    //             }
    //         } else {
    //             $fetchInTimeId = carInoutTime::where('vehicles_id', $id)->where('out_time', NULL)->first()->id;
    //             DB::beginTransaction();
    //             try {
    //                 $isClientUpdated = carInoutTime::where('id', $fetchInTimeId)->update([
    //                     'out_time' => $time,
    //                     'out_time_img' => $filename
    //                 ]);
    //                 if ($isClientUpdated) {
    //                     DB::commit();
    //                     return $this->responseJson(true, 200, 'Car Time updated successfully', $isClientUpdated);
    //                 }
    //             } catch (\Exception $e) {
    //                 DB::rollBack();
    //                 logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
    //                 return $this->responseJson(false, 500, 'Something went wrong');
    //             }
    //         }
    //     } else {
    //         return $this->responseJson(false, 500, 'Something went wrong');
    //     }
    // }
    // *********************************************************
    public function carReport(Request $request)
    {
        $users_id = auth()->user()->id;
        // $filename = carImageUpload($request->file);
        $clients_id = $request->clients_id ?? '';
        $formCar = $request->form_vehicle_id ?? '';
        $toCar = $request->to_vehicle_id ?? '';
        $type = $request->type ?? "";
        $remarks = $request->remarks ?? '';
        DB::beginTransaction();
        try {
            $isClientCreated = Reporting::create([
                'date' => Carbon::now(),
                'user_id' => $users_id ?? '',
                'form_vehicle_id' => $formCar ?? '',
                'to_vehicle_id' => $toCar ?? '',
                'clients_id' => $request->clients_id ?? '',
                'type' => $type ?? '',
                'remarks' => $remarks ?? '',
                'img' => $filename ?? ''
            ]);
            if ($isClientCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Vehicle Data Found', $isClientCreated);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong');
        }
    }
    public function carReportList(Request $request)
    {
        $userId = $request->userId;
        $clientsId = $request->clients_id;
        $data = Reporting::with(
            'clients',
            'users',
            'formVehical',
            'toVehical'
        )->where(['clients_id' => $clientsId, 'user_id' => $userId])->get();
        return $this->responseJson(true, 200, 'Car Reporeting list Fetch successfully', $data);
    }
}
// "formCar" => "1"
//   "toCar" => null
//   "type" => "1"
//   "remarks" => "sssssdwaaaaaaaad dfghjuiou ,miunjhbgvfc kimunytbgv"
// "form_vehicle_id" => "1"
//   "to_vehicle_id" => "1"
//   "type" => "1"
//   "remarks" => "sssssdwaaaaaaaad dfghjuiou ,miunjhbgvfc kimunytbgv"
//   "clients_id" => "1"
