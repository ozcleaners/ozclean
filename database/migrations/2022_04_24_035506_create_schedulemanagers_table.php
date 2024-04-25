<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulemanagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulemanagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('zone_id');
            $table->string('date')->nullable();
            $table->string('day')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('from_hour')->nullable();
            $table->string('within_hour')->nullable();
            $table->integer('team_id')->nullable();
            $table->boolean('team_availability')->nullable();
            $table->boolean('is_booked')->nullable();
            $table->timestamps();


            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('zone_id')->references('id')->on('attribute_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulemanagers');
    }
}
