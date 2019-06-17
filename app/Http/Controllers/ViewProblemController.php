<?php

namespace FixNairobi\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ViewProblemController extends Controller
{
    //
    public function viewIssue($id)
    {
        $problem = DB::table('problems')
            ->select('*')
            ->join('IssueStatus', 'problems.id', '=', 'IssueStatus.issueid')
            ->join("Type_issues", "Type_issues.id", "=", "problems.issueid")
            ->join("photos", 'problems.id', '=', 'photos.issueid')
            ->join('users', "users.id", "=", "problems.userid")
            ->where('problems.id', '=', $id)->limit(2)->get();
        return view('Report.ViewProblem')->with("problem", $problem);
    }
    public function  issueFixed($id){
        DB::table('IssueStatus')->where('issueid','=',$id)->update([
           'status'=>"Fixed"
        ]);
    }
}
