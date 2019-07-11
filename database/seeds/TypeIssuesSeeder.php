<?php

use Illuminate\Database\Seeder;

class TypeIssuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\FixNairobi\TypeIssues::class,5)->create();
    }
}
