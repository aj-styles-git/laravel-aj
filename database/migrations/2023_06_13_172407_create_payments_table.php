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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transection_id');
            $table->string('transection_type')->nullable();
            $table->string('institute_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('reason')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('commission_amount')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('payments');
    }
};
