<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HelperController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Helper');
        $helpers = Helper::all();
        return view('admin.helpers.index', compact('helpers'));
    }
    public function add(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "phone" => 'required',
            "email" => 'required',
            "address" => 'required',
            "salary" => 'required',
            "incentive" => 'required',
            "bank_name" => 'required',
            "ifc_code" => 'required',
            "ac_no" => 'required',
            "holder_name" => 'required',
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            // if ($request->has('rc_no')) {
            //     $img = carImageUpload($request->rc_no);
            // }
            $isHelperCreated = Helper::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'salary' => $request->salary,
                'incentive' => $request->incentive,
                'bank_name' => $request->bank_name,
                'ifc_code' => $request->ifc_code,
                'ac_no' => $request->ac_no,
                'holder_name' => $request->holder_name
            ]);
            // dd($isHelperCreated);
            if ($isHelperCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Helper Created Successfully');
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
            try {
                $id = uuidtoid($uuid, 'helpers');
                $isHelperUpdated = Helper::where('id', $id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'salary' => $request->salary,
                    'incentive' => $request->incentive,
                    'bank_name' => $request->bank_name,
                    'ifc_code' => $request->ifc_code,
                    'ac_no' => $request->ac_no,
                    'holder_name' => $request->holder_name
                ]);
                if ($isHelperUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Helpers updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }
}
