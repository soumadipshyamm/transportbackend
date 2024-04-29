<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class VendorsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setPageTitle('Vendor');
        // $id = uuidtoid($request->vendor_id, 'vendors');
        $vendors = Vendors::all();
        return view('admin.vendor.index', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required| numeric  ",
            "ac_no" => "sometimes| numeric  ",
            "email" => "required|email",
            "address" => "required"
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $isVendorCreated = Vendors::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'bank_name' => $request->bank_name,
                'ifc_code' => $request->ifc_code,
                'ac_no' => $request->ac_no,
                'holder_name' => $request->holder_name,
            ]);
            // dd($isVendorCreated);
            if ($isVendorCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Vendor Created Successfully', route('vendor.list'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong', route('vendor.list'));
        }
    }
    public function edit(Request $request, $uuid)
    {
        if ($request->post()) {
            // $request->validate([
            // ]);
            // dd($request->all());
            DB::beginTransaction();
            try {
                $id = uuidtoid($uuid, 'vendors');
                $isClientUpdated = Vendors::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'bank_name' => $request->bank_name,
                    'ifc_code' => $request->ifc_code,
                    'ac_no' => $request->ac_no,
                    'holder_name' => $request->holder_name,
                ]);
                if ($isClientUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Vendors updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }

}
