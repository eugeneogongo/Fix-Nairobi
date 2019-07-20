<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Photos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::Create('photos',function (Blueprint $table){
       $table->integer('issueid')->unsigned();
       $table->foreign('issueid')->references('id')->on('problems');
       $table->string('path');
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
        Schema::drop('photos');
    }
}
