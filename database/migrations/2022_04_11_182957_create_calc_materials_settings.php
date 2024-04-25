<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalcMaterialsSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calc_materials_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('section_id');
            $table->string('material_title');
            $table->unsignedBigInteger('equation_type')->nullable();
            $table->string('rate')->nullable();
            $table->string('extras_connection')->nullable();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('section_id')->references('id')->on('calc_service_settings');
            $table->foreign('equation_type')->references('id')->on('attribute_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calc_materials_settings');
    }
}
