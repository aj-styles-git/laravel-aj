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
            $table->id();
            $table->string('course_id');
            $table->string('language_id')->default(1001);
            $table->string('institute_id')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('des')->nullable();
            $table->Integer('price')->nullable();
            $table->Integer('discount')->nullable();
            $table->Integer('mode')->nullable();
            $table->Integer('seats')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('is_published')->nullable();
            $table->string('created_by')->nullable();
            $table->string('status_id')->default(0);
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
};
