<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('caddress')->nullable();
            $table->string('ccity')->nullable();
            $table->string('cstate')->nullable();
            $table->string('czip')->nullable();
            $table->string('chome_phone')->nullable();
            $table->string('cmobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('paddress')->nullable();
            $table->string('pcity')->nullable();
            $table->string('pstate')->nullable();
            $table->string('pzip')->nullable();
            $table->string('date_inspection')->nullable();
            $table->string('time_inspection')->nullable();
            $table->text('final_remarks')->nullable();
            $table->string('access_key')->nullable();
            $table->integer('rating')->nullable();
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
        Schema::drop('reports');
    }
}
