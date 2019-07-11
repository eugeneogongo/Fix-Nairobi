<?php

namespace FixNairobi\Http\Controllers;

use FixNairobi\Feedback;

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
        return view('admin.dashboard');
    }

    public  function  feedbacks(){
        $feedbacks = Feedback::all();

        return view('admin.allfeedbacks')->with([
            'feedbacks'=>$feedbacks]);
    }

}
