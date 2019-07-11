<?php

use Illuminate\Database\Seeder;

class FeedBackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $feedback = factory(\FixNairobi\Feedback::class,50)->create();
    }
}
