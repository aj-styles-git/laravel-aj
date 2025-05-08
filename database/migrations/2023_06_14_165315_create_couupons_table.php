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
        Schema::create('couupons', function (Blueprint $table) {
            $table->id();
            $table->string('institute_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('coupon_type')->nullable();
            $table->string('amount')->default(0);
            $table->string('code')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->datetime('status')->comment('1=Active;0=Disabled');
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
        Schema::dropIfExists('couupons');
    }
};
