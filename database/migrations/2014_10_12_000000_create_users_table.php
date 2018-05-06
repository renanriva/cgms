<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->unique();

            // USER PERMISSION & SETTINGS SPECIFIC
            $table->tinyInteger('role')->default(USER_ROLE_ADMIN); //1. admin, 2. student, 3. teacher
            $table->tinyInteger('status')->default(USER_STATUS_ACTIVE); //1. active, 0. inactive

//            $table->string('social_id')->unique();  // CEDULA


//            $table->integer('parish_id')->nullable();       // gender
//            $table->string('canton')->nullable();       // gender
//            $table->string('province')->nullable();       // gender
//            $table->string('dist_id')->nullable();  // district_id
//            $table->string('zone')->nullable();     // zone

            /*
            $table->string('cc')->nullable();       // c_c
            $table->string('amie')->nullable();       // AMIE
            $table->date('date_of_birth')->nullable();       // DOB

            $table->string('gender')->nullable();       // gender
            $table->string('telephone')->nullable();       // gender
            $table->string('mobile')->nullable();       // gender

            $table->string('inst_email')->nullable();       // UNIVERSITY email



            $table->string('function')->nullable();         // gender
            $table->string('function_type')->nullable();       // REGIMEN LABORAL
            $table->string('reason_type')->nullable();       // TIPO RAZON
            $table->string('action_type')->nullable();       // TIPO RAZON
            $table->string('action_description')->nullable();       // EXPLICACION ACCION
            $table->string('speciality')->nullable();       // ESPECIALIDAD

            $table->date('start_date')->nullable();       // c_c
            $table->date('end_date')->nullable();       // c_c


            $table->string('function_category')->nullable();       // CATEGORIA
            $table->string('university')->nullable();       // INSTITUCION EDUCATIVA
            $table->string('ETNIA')->nullable();       // INSTITUCION EDUCATIVA

            */

            $table->string('password');

            $table->string('creation_type')->default(USER_CREATION_TYPE_CMS);        // 1.by online, 2. by_import
            $table->bigInteger('created_by')->nullable();        // logged in user id
            $table->bigInteger('updated_by')->nullable();        // logged in user id

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
