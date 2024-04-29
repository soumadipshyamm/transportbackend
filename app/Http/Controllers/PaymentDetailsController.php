<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetails;
use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;

class PaymentDetailsController extends BaseController
{
    public function index(Request $request)
    {
        $this->setPageTitle('Payment Details');
        $fetchPaymet = PaymentDetails::all();
        return view('admin.payment-details.index', compact('fetchPaymet'));
    }
}
