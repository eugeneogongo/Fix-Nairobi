<?php

namespace FixNairobi\Http\Controllers;

use FixNairobi\TypeIssues;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
{
    //you must be signed in
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  show(){
       return view('admin.newissue');
    }
    public function createIssue(Request $request){
        $validator = Validator::make(\request()->all(),[
           'desc'=>'required'
        ],[
            'desc.required'=>'A descriptio is required'
        ])->validate();

        try {
            $issue = new TypeIssues();
            $issue->desc = $request->get('desc');
            $issue->save();
            return response()->json(["status" => "success"]);
        } catch (Exception $ex) {
            return \response()->json(['status' => "error"]);
        }


    }
}
