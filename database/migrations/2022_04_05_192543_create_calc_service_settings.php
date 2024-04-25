<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcServiceSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calc_service_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('service_slug');
            $table->string('service_icon')->nullable();
            $table->integer('base_price');
            $table->integer('extra_default');
            $table->integer('minimum_qty');
            $table->integer('maximum_qty');
            $table->integer('minimum_price');
            $table->string('service_title');
            $table->string('service_sub_title');
            $table->string('service_title_slug');
            $table->unsignedBigInteger('setting_option_type')->nullable();
            $table->unsignedBigInteger('calculation_type')->nullable();
            $table->unsignedBigInteger('counter_type')->nullable();
            $table->enum('computable', ['Yes', 'No']);
            $table->longText('tooltips_content')->nullable();
            $table->longText('notes')->nullable();
            $table->enum('material_available', ['Yes', 'No']);
            $table->enum('storey_available', ['Yes', 'No']);
            $table->integer('sorting_order');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('setting_option_type')->references('id')->on('attribute_values');
            $table->foreign('calculation_type')->references('id')->on('attribute_values');
            $table->foreign('counter_type')->references('id')->on('attribute_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calc_service_settings');
    }
}
