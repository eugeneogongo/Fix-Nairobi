<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;

use FixNairobi\Jobs\BulkEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class BroadCastController extends Controller
{

    //
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function show()
    {
        return view('admin.createbroadcast');
    }

    public function send(Request $request)
    {

        $Users = DB::table('users')->select('*')->distinct('email')->get();

        foreach ($Users as $user) {
            $job = new BulkEmailJob();
            $job->setSendto($user->email);
            $job->setSubject($request->subject);
            $job->setTemplate($request->editordata);
            Queue::push($job);
        }
        return response()->redirectTo('admin');

    }
}
