<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Models\User;

class ClientsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->setPageTitle('Clients');
        $clients = Clients::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'location.*.name' => 'required|string',
            'location.*.sub_locations.*' => 'nullable|string', // Assuming sub-locations are optional
        ]);

        DB::beginTransaction();
        try {
            // Extracting main client data
            $clientData = [
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
            ];

            // Creating or updating the client record
            $client = Clients::updateOrCreate(
                ['email' => $validatedData['email']], // Assuming email is unique
                $clientData
            );

            // Handling locations and sub-locations
            foreach ($request->location as $locationData) {
                $location = $client->locations()->updateOrCreate(
                    ['location' => $locationData['name']], // Assuming location names are unique per client
                    ['location' => $locationData['name']]
                );

                if ($locationData) {
                    foreach ($locationData['sub_locations'] as $subLocationData) {
                        $subLocation = $location->subLocations()->updateOrCreate(
                            ['sub_location' => $subLocationData],
                            ['sub_location' => $subLocationData] // Assuming sub-location names are unique per location
                        );
                    }
                }
            }
            if ($subLocation) {
                DB::commit();
                return $this->responseJson(true, 200, 'Client Created Successfully', route('client.list'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong', route('client.list'));
        }
    }


    // public function add(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         "name" => 'required|string|min:3',
    //         "phone" => 'required',
    //         "email" => 'required|email'
    //     ]);
    //     DB::beginTransaction();
    //     try {
    //         $isClientCreated = Clients::create([
    //             'uuid' => Str::uuid(),
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone' => $request->phone
    //         ]);
    //         if ($isClientCreated) {
    //             DB::commit();
    //             return $this->responseJson(true, 200, 'Client Created Successfully', route('client.list'));
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
    //         return $this->responseJson(false, 500, 'Something Went Wrong', route('client.list'));
    //     }
    // }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $uuid)
    {
        if ($request->post()) {
            // $request->validate([
            // ]);
            // dd($request->all());
            DB::beginTransaction();
            try {
                $id = uuidtoid($uuid, 'clients');
                $isClientUpdated = Clients::where('id', $id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]);
                if ($isClientUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Clients updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }

    public function alloction()
    {
        $this->setPageTitle('Clients');
        $clientsAlloctions = User::with('clientsAlloction')->where('type', 1)->get();
        // dd($clientsAlloctions->toArray());
        return view('admin.clientAlloction.index', compact('clientsAlloctions'));
    }

    public function addAlloction(Request $request)
    {
        // dd($request->all());
        $getClients = $request->clients;
        $getSupervisor = $request->supervisor;
        // dd($getSupervisor);
        DB::beginTransaction();
        try {
            foreach ($getClients as $key => $client) {
                DB::table('client_alloctions')->insert([
                    'user_id' => $getSupervisor,
                    'clients_id' => $client
                ]);
                // echo $getSupervisor;
            }
            DB::commit();
            return $this->responseJson(true, 200, "Client Alloction  Added Successfully");
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseRedirectBack('We are facing some issue', 'info', true, true);
        }
    }

    public function editAlloction(Request $request, $uuid)
    {
        if ($request->post()) {
            // $request->validate([
            // ]);
            // dd($request->all());
            $getClients = $request->clients;
            $id = uuidtoid($uuid, 'users');
            // dd($getClients);
            $deleteIds = DB::table('client_alloctions')->where('user_id', $id)->get();
            if ($deleteIds != null) {
                DB::beginTransaction();
                try {
                    // dd($deleteIds);
                    foreach ($deleteIds as $deleteId) {
                        DB::table('client_alloctions')->where('user_id', $deleteId->user_id)->delete();
                    }
                    foreach ($getClients as $key => $clientId) {
                        DB::table('client_alloctions')->insert([
                            'user_id' => $id,
                            'clients_id' => $clientId
                        ]);
                    }
                    // if ($isClientUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Clients updated successfully');
                    // }
                } catch (\Exception $e) {
                    DB::rollBack();
                    logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                    return $this->responseJson(false, 500, 'Something went wrong');
                }
            } else {
                DB::beginTransaction();
                try {
                    foreach ($getClients as $key => $clientId) {
                        DB::table('client_alloctions')->insert([
                            'user_id' => $id,
                            'clients_id' => $clientId
                        ]);
                    }
                    // if ($isClientUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Clients updated successfully');
                    // }
                } catch (\Exception $e) {
                    DB::rollBack();
                    logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                    return $this->responseJson(false, 500, 'Something went wrong');
                }
            }
        }
    }
}

// "_token" => "O4aSeFkBamdjfngJzkJnRB2jpg5C4a1cWXm78Jzn"
// "supervisor" => "3"
// "clients" => array:1 [
//   0 => "2"
