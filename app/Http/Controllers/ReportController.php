<?php

namespace FixNairobi\Http\Controllers;

use FixNairobi\IssueStatus;
use FixNairobi\Jobs\SendAckEmail;
use FixNairobi\Mail\ProblemReported;
use FixNairobi\Photo;
use FixNairobi\Problem;
use FixNairobi\TypeIssues;
use Exception;
use Illuminate\Http\Request;



class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public  function  Show(){
        $type_issues = TypeIssues::all();
        return view('Report/Reportproblem', compact('type_issues',$type_issues))->withTitle('Report a Problem');

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
            $problem->title = $request->get('desc');
            $problem->save();


            //save pics
            $this->saveImage($problem->id, $request, 'image1');
            $this->saveImage($problem->id, $request, 'image2');

            //Use default status of not fixed
            $issuestatus = new IssueStatus();
            $issuestatus->issueid = $problem->id;
            $issuestatus->save();

            //Send Acknowledgement Email SendA(new SendAckEmail());
            SendAckEmail::dispatchNow(new SendAckEmail());

            return response()->json(["status" => "success"]);


        } catch (Exception $ex) {
            return response()->json(["status" => $ex->getMessage()]);
        }

    }

    function saveImage($id, $request, $imagename)
    {
        if ($request->hasFile($imagename)) {
            $pic = new Photo();
            $image = $request->file($imagename);
            $name = time() . ' ' . $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $pic->path = $name;
            $pic->issueid = $id;
            $pic->save();
        }

    }
}
