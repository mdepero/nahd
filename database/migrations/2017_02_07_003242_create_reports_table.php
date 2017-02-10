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
            $table->string('fname');
            $table->string('lname');
            $table->string('caddress');
            $table->string('ccity');
            $table->string('cstate');
            $table->string('czip');
            $table->string('chome_phone');
            $table->string('cmobile_phone');
            $table->string('email');
            $table->string('paddress');
            $table->string('pcity');
            $table->string('date_inspection');
            $table->string('time_inspection');
            $table->text('final_remarks');
            $table->string('access_key');
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
