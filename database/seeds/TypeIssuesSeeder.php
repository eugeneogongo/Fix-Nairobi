<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

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
