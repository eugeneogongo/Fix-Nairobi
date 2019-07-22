<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    { $problems  =DB::table('problems')
        ->select('problems.id as id','moredetails as detail','Title','location',"Type_issues.desc",'problems.created_at as publisheddat')
        ->join('IssueStatus','problems.id','=','IssueStatus.issueid')
        ->join("Type_issues","Type_issues.id","=","problems.issueid")
        ->where('status','=','Not Fixed')->orderBy('problems.created_at', 'desc')
        ->limit(4)-> get();
        return view('index')->with([
            "problems"=>$problems
        ])->withTitle("FixNairobi");
    }

    public function showAbout(){
        return view('pages.about')->withTitle('About - Fix Nairobi');
    }


}
