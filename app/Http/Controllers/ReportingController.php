<?php

namespace App\Http\Controllers;

use App\Models\Reporting;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function index()
    {
    return view('admin.');
    }
}
