<?php

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
