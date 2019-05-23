<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsadmin extends Migration
{
    /**
     * adds is admin
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table){
            $table->boolean('isAdmin')->nullable()->after('password');
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
