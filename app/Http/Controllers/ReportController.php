<?php

namespace App\Http\Controllers;

use App\TypeIssues;
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
        $type_issues = TypeIssues::all();
        return view('report.Reportproblem', compact('type_issues',$type_issues))->withTitle('Report a Problem');

    }
    public function  reportIssue(Request $request){

    }
}
