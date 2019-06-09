<?php

namespace FixNairobi\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        return view('index')->withTitle("FixNairobi");
    }

}
