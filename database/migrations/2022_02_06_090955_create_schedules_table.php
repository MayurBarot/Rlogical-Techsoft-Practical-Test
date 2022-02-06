<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->date('date')->nullable();
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->string('table_no')->nullable();
            $table->enum('status',['Pending','Approved','Rejected'])->default('Pending');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('to_user_id')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('schedules');
    }
}
