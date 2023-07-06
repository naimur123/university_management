<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faculty_course_notices', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->longText('details')->nullable();
            $table->uuid('faculty_id')->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->uuid('course_time_schedule_id')->nullable();
            $table->foreign('course_time_schedule_id')->references('id')->on('course_time_schedules');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_course_notices');
    }
};
