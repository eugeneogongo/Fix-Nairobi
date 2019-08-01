<?php
/**
 * Developed by Eugene Ogongo on 8/1/19 2:06 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 8/1/19 2:06 PM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;

use Exception;
use FixNairobi\Notifications\ReportFixed;
use FixNairobi\Problem;
use FixNairobi\Update;
use FixNairobi\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ViewProblemController extends Controller
{
    //
    public function viewIssue($id)
    {
        $problem = DB::table('problems')
            ->select(['*', 'problems.created_at', "Type_issues.desc"])
            ->join('IssueStatus', 'problems.id', '=', 'IssueStatus.issueid')
            ->join("Type_issues", "Type_issues.id", "=", "problems.issueid")
            ->join("photos", 'problems.id', '=', 'photos.issueid')
            ->leftJoin('users', "users.id", "=", "problems.userid")
            ->where('problems.id', '=', $id)->limit(2)->get();
        if($problem->isEmpty()){
            abort(404,"The Problem was either deleted or not found");
        }

        $updates = Update::all()->where("issueid", '=', $id)->take(3);

        return view('Report.ViewProblem')->with(["problem" => $problem, "updates" => $updates]);

    }

    public function  issueFixed(Request $request){

        $id = $request->id;
        try{
            DB::table('IssueStatus')->where('issueid','=',$id)->update([
                'status'=>"Fixed"
            ]);
        } catch (Exception $ex) {
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

    //update problem
    public function update(Request $request)
    {
        $update = new Update();

        $update->content = $request->update;
        if (Auth::check()) {
            $update->userid = \auth()->user()->id;
        }
        $update->issueid = $request->problemid;
        if ($update->save()) {

        }
        return response()->redirectTo('/report/update/' . $request->problemid);
    }

    //shows the success window
    public function success($id)
    {
        $problem = Problem::all('*')->where('id', '=', $id)->first();
        return view('Report.update')->with(['problem' => $problem]);
    }
}
