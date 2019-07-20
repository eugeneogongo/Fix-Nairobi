<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

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
