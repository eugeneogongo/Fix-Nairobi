<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IssueStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('IssueStatus',function (Blueprint $table){
           $table->integer('issueid')->unsigned();
           $table->string('status')->default('Not Fixed');
           $table->foreign('issueid')->references('id')->on('problems');
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
        Schema::drop('IssueStatus');
    }
}
