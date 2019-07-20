<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       DB::table('users')->insert([
           'name' => 'admin',
           'email' => 'admin@live.com',
           'password'=>Hash::make ("12345678"),
           'isAdmin'=>1
       ]);

       $type = new \FixNairobi\TypeIssues();
       $type->desc = 'Stalled vehicle';
       $type->save();
    }
}
