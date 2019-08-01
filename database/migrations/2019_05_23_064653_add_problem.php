<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProblem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems',function (Blueprint $table){
            $table->increments('id');
            $table->integer('userid')->unsigned();

            $table->string('location')->nullable(false);
            $table->string('Title')->nullable(false);
            $table->integer('issueid')->unsigned();

            $table->string('landmark');
            $table->string('moredetails');
            $table->timestamps();
            $table->foreign('issueid')->references('id')->on('Type_issues');
            $table->foreign('userid')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('problems');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
