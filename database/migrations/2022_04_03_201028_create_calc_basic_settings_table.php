<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcBasicSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calc_basic_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('service_slug');
            $table->string('service_icon')->nullable();
            $table->unsignedBigInteger('setting_type');
            $table->string('setting_title');
            $table->string('setting_sub_title');
            $table->unsignedBigInteger('equation_type');
            $table->string('rate');
            $table->enum('show_on_calculator', ['Yes', 'No']);
            $table->enum('computable', ['Yes', 'No']);
            $table->integer('sorting_order');
            $table->enum('which_module', ['Basic', 'Other']);
            $table->unsignedBigInteger('section_id')->nullable();
            $table->enum('intial_selected', ['Yes'])->nullable();
            $table->enum('calculate_with', ['After Total','Before Total'])->nullable();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('setting_type')->references('id')->on('attribute_values');
            $table->foreign('equation_type')->references('id')->on('attribute_values');
            $table->foreign('section_id')->references('id')->on('calc_service_settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calc_basic_settings');
    }
}
