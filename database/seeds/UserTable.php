<?php

use Illuminate\Database\Seeder;

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
        $user = new \FixNairobi\User();
        $user->name="eugene ogongo";
        $user->email="eugeneogongo@live.com";
        $user->isAdmin = 1;
        $user->password = \Illuminate\Support\Facades\Hash::make('eugene2001');
    }
}
