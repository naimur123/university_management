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
        Schema::create('faculties', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('user_id')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('rank')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile')->nullable();
            $table->text('presentaddress')->nullable();
            $table->text('permanentaddress')->nullable();
            $table->enum('sex',['m','f','o'])->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->enum("maritalstatus", ["single", "married", "divorced"])->nullable();
            $table->string('password')->nullable();
            $table->string('profile')->nullable();
            $table->uuid('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            // $table->foreignId('department_id')->nullable()->references('id')->on('departments');
            // $table->integer('added_by')->nullable();
            // $table->integer('updated_by')->nullable();
            $table->uuid('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('administrators');
            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('administrators');
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
        Schema::dropIfExists('faculties');
    }
};
