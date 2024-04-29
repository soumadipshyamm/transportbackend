<?php

namespace App\Http\Controllers;

use App\Models\Supervisors;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\User;

class SupervisorsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Supervisors');
        $supervisors = User::where('type',1)->get();
        return view('admin.supervisor.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // dd($request->all());

        $request->validate([
            "name" => 'required|string|min:3',
            "phone" => 'required',
            "email" => 'required|email',
            'password' => 'required|password'
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $isSupervisorCreated = User::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type'=>'1',
                'password' => Hash::make($request->password)
            ]);
            if ($isSupervisorCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Supervisor Created Successfully', route('supervisor.list'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong', route('supervisor.list'));
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
                $id = uuidtoid($uuid, 'users');
                $isVehiclesUpdated = User::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password)
                ]);
                if ($isVehiclesUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'SuperVisor updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }
}
