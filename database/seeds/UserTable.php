<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTable extends Seeder
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
           'name'=>'eugene ogongo',
           'email'=>'eugeneogongo@live.com',
           'password'=>\Illuminate\Support\Facades\Hash::make("12345678"),
           'isAdmin'=>1
       ]);
    }
}
