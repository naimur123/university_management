<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_time_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->text('day')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->uuid('faculty_id')->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->uuid('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->string('session')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_time_schedules');
    }
};
