<?php
/**
 * Developed by Eugene Ogongo on 7/24/19 7:25 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/24/19 7:25 PM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->integer('issueid')->unsigned();
            $table->foreign('issueid')->references('id')->on('problems');
            $table->integer('userid')->unsigned();
            $table->foreign('userid')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('updates');
    }
}
