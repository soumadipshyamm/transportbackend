<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clients;
use App\Models\Vendors;
use App\Models\Vehicles;
use App\Models\Supervisors;
use App\Models\carInoutTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->setPageTitle('Dashboard');
        $clients = Clients::all();
        $vendors = Vendors::all();
        $vehical = Vehicles::all();
        $supervisor = User::where('type', 1)->get();
        $carInOutReports = carInoutTime::with('clients', 'vehical')->orderBy('id', 'desc')->get();
        return view('admin.dashboard.index', compact('clients', 'vendors', 'vehical', 'supervisor', 'carInOutReports'));
    }
    public function passwordUpdate(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'new_confirm_password' => ['same:new_password'],
            ]);
            DB::beginTransaction();
            try {
                if (Hash::check($request->old_password, auth()->user()->password)) {
                    User::find(auth()->user()->id)->update([
                        'password' => Hash::make($request->new_password),
                    ]);
                    // dd($addPolicyProvied);
                    DB::commit();
                    return $this->responseRedirect(true, 200, "Your Password Updated Successfully");
                } else {
                    return $this->responseRedirectBack('do not matched the password ', 'info', true, true);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->responseRedirectBack('We are facing some issue', 'info', true, true);
            }
        } else {
            abort(405);
        }
    }

}
