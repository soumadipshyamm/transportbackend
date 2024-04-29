<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRolePermissionController extends Controller
{
    public function userAddRole()
    {
        return view('rolePermission.user-list');
    }
    public function addRole(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string'],
                'role' => 'required',
            ]);
            // dd($request->all());
            DB::beginTransaction();
            try {
                $addUser = new User();
                $addUser->uuid = Str::uuid();
                $addUser->name = $request->name;
                $addUser->email = $request->email;
                $addUser->password = Hash::make($request->password);
                $addUser->type = '2';
                $addUser->save();
                $roleFind = Roles::where('id', $request->role)->first();
                // dd($roleFind);
                $roleFind->users()->attach($addUser->id);
                // $addUserRole->user_id = $addUser->id;
                DB::commit();
                return $this->responseJson(true, 200, "User Added Successfully");
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->responseRedirectBack('We are facing some issue', 'info', true, true);
            }
        } else {
            abort(405);
        }
    }

    public function permissionManagement()
    {
        return view('rolePermission.permission');
    }

    public function addPermissionManagement(Request $request)
    {
        if ($request->ajax()) {
            $getPermission = $request->permission;
            $getUser = $request->userId;
            $userId = User::where('id', $getUser)->first()->id;

            $deletePermissions = DB::table('users_permissions')->where('user_id', $getUser)->get();
            if ($deletePermissions != null) {
                DB::beginTransaction();
                try {
                    foreach ($deletePermissions as $deletePermission) {
                        DB::table('users_permissions')->where('user_id', $deletePermission->user_id)->delete();
                    }
                    // $uuidToId = User::where('uuid', $request->editId)->first();
                    // dd($uuidToId);
                    foreach ($getPermission as $key => $permission) {
                        DB::table('users_permissions')->insert([
                            'user_id' => $userId,
                            'permission_id' => $permission
                        ]);
                    }
                    DB::commit();
                    return $this->responseJson(true, 200, "User Permission Added Successfully");
                } catch (\Exception $e) {
                    DB::rollBack();
                    return $this->responseRedirectBack('We are facing some issue', 'info', true, true);
                }
            } else {
                DB::beginTransaction();
                try {
                    foreach ($getPermission as $key => $permission) {
                        DB::table('users_permissions')->insert([
                            'user_id' => $userId,
                            'permission_id' => $permission
                        ]);
                    }
                    DB::commit();
                    return $this->responseJson(true, 200, "User Permission Added Successfully");
                } catch (\Exception $e) {
                    DB::rollBack();
                    return $this->responseRedirectBack('We are facing some issue', 'info', true, true);
                }
            }
        } else {
            abort(405);
        }
    }

    public function featchRolePermission(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $id = $request->all();
            $fetchData['permission'] = Permissions::all();
            $fetchData['user'] = User::where('uuid', $id)->first();
            $fetchData['user']->userPermission;
            // dd( $fetchData['user']);
            return $fetchData;
        } else {
            abort(405);
        }
    }
}



