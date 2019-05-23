<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('index')->withTitle("Fix Nairobi");
    }
    /**
     * Show the application dashboard.
     *
     *
     */
    public function admin()
    {
        return view('admin.dashboard');
    }
}
