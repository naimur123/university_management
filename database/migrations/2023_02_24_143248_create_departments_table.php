<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary()->unique();
            $table->string('name');
            $table->string('curriculum');
            $table->string('curriculum_short_name')->nullable();
            $table->integer('total_credit');
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
        Schema::dropIfExists('departments');
    }
};
