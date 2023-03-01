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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('code')->nullable();
            $table->string('course_name')->nullable();
            $table->string('prereq')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('sem')->nullable();
            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            // $table->foreignId('department_id')->nullable()->references('id')->on('departments');
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
        Schema::dropIfExists('courses');
    }
};
