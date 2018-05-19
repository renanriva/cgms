<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->string('course_id', 40);
            $table->string('course_type', 100)->nullable();
            $table->string('short_name', 150)->nullable();
            $table->string('modality', 100)->nullable();

            $table->text('description')->nullable();
            $table->integer('hours')->default(0);
            $table->date('start_date');
            $table->date('end_date');

            $table->integer('quota')->default(0);
            $table->string('video_url')->nullable();
            $table->string('video_type')->nullable(); //@todo define video type
            $table->text('comment')->nullable();


            $table->bigInteger('university_id')->unsigned();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('courses');
    }
}
