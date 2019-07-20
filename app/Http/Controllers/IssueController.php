<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

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
