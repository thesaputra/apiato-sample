<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursecategoryTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('course_categories');
    }
}
