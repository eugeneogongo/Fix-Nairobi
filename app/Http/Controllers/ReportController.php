<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ViewErrorBag;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public  function  Show(){

        return view('report.Reportproblem')->withTitle('Report a Problem');

    }
}
