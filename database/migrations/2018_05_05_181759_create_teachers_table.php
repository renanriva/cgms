<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {

            $table->engine = 'InnoDB';


            $table->bigIncrements('id');

            $table->string('social_id')->unique();  // CEDULA

            $table->string('cc')->nullable();       // c_c
            $table->string('amie')->nullable();       // AMIE
            $table->date('date_of_birth')->nullable();       // DOB

            $table->string('gender')->nullable();       // gender
            $table->string('telephone')->nullable();       // gender
            $table->string('mobile')->nullable();       // gender

            $table->string('inst_email')->nullable();       // UNIVERSITY email



            $table->string('function')->nullable();
            $table->string('function_type')->nullable();
            $table->string('reason_type')->nullable();
            $table->string('action_type')->nullable();
            $table->string('action_description')->nullable();
            $table->string('speciality')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();



            $table->string('function_category')->nullable();       // CATEGORIA

            $table->string('university_name', 255)->nullable();       // INSTITUCION EDUCATIVA

            $table->string('ethnic_group', 100)->nullable();       // INSTITUCION EDUCATIVA

            $table->integer('parroquia_id')->nullable();       // parroquia
//            $table->foreign('parroquia_id')->references('id')->on('parroquias')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
