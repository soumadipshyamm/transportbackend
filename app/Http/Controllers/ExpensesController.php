<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExpensesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->setPageTitle('Expense');
        $expenses = Expenses::all();
        return view('admin.expense.index', compact('expenses'));
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
            "driver_name" => "required",
            "date" => "required",
            "expense_amount" => "required",
            "purposes" => "required",
            'in_time' => "required",
            'out_time' => "required",
            'meter' => "required",
        ]);
        DB::beginTransaction();
        try {
            // dd($request->all());
            $isExpensesCreated = new Expenses();
            $isExpensesCreated->uuid = Str::uuid();
            $isExpensesCreated->driver_name = $request->driver_name;
            $isExpensesCreated->date = $request->date;
            $isExpensesCreated->expense_amount = $request->expense_amount;
            $isExpensesCreated->purposes = $request->purposes;
            $isExpensesCreated->in_time = $request->in_time;
            $isExpensesCreated->out_time = $request->out_time;
            $isExpensesCreated->meter = $request->meter;
            $isExpensesCreated->vehicles_id = $request->vehicles_id;
            $isExpensesCreated->save();


            // dd($isExpensesCreated);
            if ($isExpensesCreated) {
                DB::commit();
                return $this->responseJson(true, 200, 'Expenses Created Successfully', route('expense.list'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
            return $this->responseJson(false, 500, 'Something Went Wrong', route('expense.list'));
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
                $id = uuidtoid($uuid, 'expenses');
                $isClientUpdated = Expenses::where('id', $id)->update([
                    'driver_name' => $request->driver_name,
                    'date' => $request->date,
                    'expense_amount' => $request->expense_amount,
                    'purposes' => $request->purposes,
                    'in_time' => $request->in_time,
                    'out_time' => $request->out_time,
                    'meter' => $request->meter,
                    'vehicles_id' => $request->vehicles_id,
                ]);
                if ($isClientUpdated) {
                    DB::commit();
                    return $this->responseJson(true, 200, 'Expenses updated successfully');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                logger($e->getMessage() . '--' . $e->getFile() . '--' . $e->getLine());
                return $this->responseJson(false, 500, 'Something went wrong');
            }
        }
    }

}
