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
            $table->id();
            $table->string('user_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('rank')->nullable();
            $table->date('dob')->nullable();
            $table->text('presentaddress')->nullable();
            $table->text('parmanentaddress')->nullable();
            $table->enum('sex',['m','f','o'])->nullable();;
            $table->string('nationality');
            $table->string('religion')->nullable();
            $table->enum("maritalstatus", ["single", "married", "divorced"])->nullable();
            $table->string('password');
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
