<?php

namespace FixNairobi\Http\Controllers;

use FixNairobi\TypeIssues;
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
        Validator::make(\request()->all(), [
           'desc'=>'required'
        ],[
            'desc.required' => 'A description is required'
        ])->validate();

            $issue = new TypeIssues();
            $issue->desc = $request->get('desc');
            $issue->save();
            return response()->json(["status" => "success"]);

    }
}
