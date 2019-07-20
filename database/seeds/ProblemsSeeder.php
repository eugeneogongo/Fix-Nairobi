<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Database\Seeder;

class ProblemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\FixNairobi\User::class,10)->create()->each(function ($user){
          $problem = factory(\FixNairobi\Problem::class)->make();

          $status = factory(\FixNairobi\IssueStatus::class)->make();
          $user->problem()->save($problem);
            $pic = factory(\FixNairobi\Photo::class)->make([
                'issueid'=>$problem->id
            ]);
          $pic->save();
          $problem->status()->save($status);



        });
    }
}
