<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostcodeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcode_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('postcode_id');
            $table->string('postcode');
            $table->unsignedBigInteger('service_id');
            $table->integer('rate');
            $table->unsignedBigInteger('equation_type');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('zone_id')->references('id')->on('attribute_values');
            $table->foreign('equation_type')->references('id')->on('attribute_values');
            $table->foreign('postcode_id')->references('id')->on('postcodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcode_rates');
    }
}
