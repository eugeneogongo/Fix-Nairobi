<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;

use FixNairobi\Notifications\ReportFixed;
use FixNairobi\Problem;
use FixNairobi\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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
        if($problem->isEmpty()){
            abort(404,"The Problem was either deleted or not found");
        }
        return view('Report.ViewProblem')->with("problem", $problem);

    }
    public function  issueFixed(Request $request){
        $id = $request->id;
        try{
            DB::table('IssueStatus')->where('issueid','=',$id)->update([
                'status'=>"Fixed"
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'=>'failure'
            ]);
        }
        $problem = Problem::where('id',$id)->first();
        $user  = User::where("id",$problem->userid)->first();


        Notification::send($user,new ReportFixed($user,$id));
        return response()->json([
            'status'=>'success'
        ]);
    }
}
