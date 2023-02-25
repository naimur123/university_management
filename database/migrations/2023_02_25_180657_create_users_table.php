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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('fathername')->nullable();
            $table->string('mothername')->nullable();
            $table->text('presentaddress')->nullable();
            $table->text('parmanentaddress')->nullable();
            $table->date('dob')->nullable();
            $table->enum('sex',['m','f','o'])->nullable();;
            $table->string('nationality');
            $table->string('religion')->nullable();
            $table->enum("maritalstatus", ["single", "married", "divorced"])->nullable();
            $table->string('program')->nullable();
            $table->float('cgpa')->nullable();
            $table->integer('credit')->nullable();
            $table->string('password');
            $table->string('profile')->nullable();
            $table->foreignId('department_id')->nullable()->references('id')->on('departments');
            // $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
