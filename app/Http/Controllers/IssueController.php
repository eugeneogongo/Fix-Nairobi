<?php

namespace App\Http\Controllers;

use App\TypeIssues;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    //you must be signed in
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function  show(){
       return view('admin.newissue');
    }
    protected function createIssue(Request $request){
        $issue =  new TypeIssues();
        $issue->desc = $request->get('desc');
        $issue->save();
    }
}
