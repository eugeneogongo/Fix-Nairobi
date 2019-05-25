<?php

namespace App\Http\Controllers;

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


}
