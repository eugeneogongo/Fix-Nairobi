<?php
/**
 * Developed by Eugene Ogongo on 7/24/19 7:24 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/24/19 7:24 PM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProblems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('problems', function (Blueprint $table) {
            $table->integer('userid')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
