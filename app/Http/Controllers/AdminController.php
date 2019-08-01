<?php
/**
 * Developed by Eugene Ogongo on 8/1/19 2:04 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 8/1/19 2:04 PM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;

use FixNairobi\Feedback;
use FixNairobi\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     *
     */
    //you must be signed in
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $feedback = Feedback::all()->last();
        $stats = DB::select(DB::raw("SELECT type_issues.desc,count(*) as \"count\" from type_issues inner join problems on problems.issueid = type_issues.id GROUP by type_issues.desc"));
        return view('admin.dashboard')->with(['feedback' => $feedback, "stats" => $stats]);
    }

    public  function  feedbacks(){
        $feedbacks = Feedback::all();


        return view('admin.allfeedbacks')->with([
            'feedbacks'=>$feedbacks]);
    }

    public function adminpage()
    {
        return view('admin.newadmin');
    }

    public function createadmin(Request $request)
    {

        $user = User::all()->where("email", "=", $request->email)->first();
        if ($user != null) {
            $user->isAdmin = true;
            if ($user->save()) {
                return view("admin.newadmin")->with(["success" => true]);
            }
        } else {
            return view("admin.newadmin")->with(["error" => true]);
        }
    }

}
