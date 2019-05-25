<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ViewProblemController extends Controller
{
    //
    public function viewIssue($id)
    {
        $problem = DB::table('problems')
            ->select('*')
            ->join('issuestatus', 'problems.id', '=', 'issuestatus.issueid')
            ->join("type_issues", "type_issues.id", "=", "problems.issueid")
            ->join("photos", 'problems.id', '=', 'photos.issueid')
            ->join('users', "users.id", "=", "problems.userid")
            ->where('problems.id', '=', $id)->limit(2)->get();
        return view('Report.ViewProblem')->with("problem", $problem);
    }
}
