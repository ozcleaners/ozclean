<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcInputTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calc_input_types', function (Blueprint $table) {
            $table->id();
            $table->enum('setting_type', ['calcbasic', 'calcservice']);
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('attr_id');
            $table->string('input_type');
            $table->unsignedBigInteger('radio_design');
            $table->integer('input_icon');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('attr_id')->references('id')->on('attribute_values');
            $table->foreign('radio_design')->references('id')->on('attribute_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calc_input_types');
    }
}
