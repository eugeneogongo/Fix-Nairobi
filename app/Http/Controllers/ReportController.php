<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;

use Exception;
use FixNairobi\Feedback;
use FixNairobi\Jobs\SendAckEmail;
use FixNairobi\Notifications\ProblemReceived;
use FixNairobi\Notifications\RegisterSuccess;
use FixNairobi\Photo;
use FixNairobi\Problem;
use FixNairobi\TypeIssues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;


class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'reportfeed']);
    }

    //
    public  function  Show(){
        $type_issues = TypeIssues::all();
        return view('Report.ReportProblem', compact('type_issues',$type_issues))->withTitle('Report a Problem');

    }

    public function  reportIssue(Request $request){
        try {

            //save details
            $problem = new Problem();
            $problem->userid = auth()->user()->id;
            $problem->location = $request->get('location');
            $problem->issueid = $request->get('issueid');
            $problem->landmark = $request->get('landmark');
            $problem->moredetails = $request->get('moredetails');
            $problem->Title = $request->get('desc');
            $problem->save();


            //save pics
            $this->saveImage($problem->id, $request, 'image1');
            $this->saveImage($problem->id, $request, 'image2');

            //Use default status of not fixed
            DB::table("IssueStatus")->insert([
                "issueid"=> $problem->id
            ]);

            Notification::send(auth()->user(), new ProblemReceived());

            return response()->json(["status" => "success"]);


        } catch (Exception $ex) {
            return response()->json(["status" => $ex->getMessage()]);
        }

    }

    function saveImage($id, $request, $imagename)
    {
        if ($request->hasFile($imagename)) {
          $path =  $request->file($imagename)->store('public');
            DB::table('photos')->insert([
                "path"=>$path,
               "issueid"=>$id
            ]);
        }

    }

    public function reportfeed(Request $request)
    {
        $feedback = new Feedback();
        $feedback->email = $request->email;
        $feedback->message = $request->message;

        if ($feedback->save()) {
            return view('pages.complainform')->withMessage('success');
        }
        return redirect(route('complain'));
    }
}
