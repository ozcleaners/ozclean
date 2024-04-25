<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermCustomFieldsBreakdown extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_custom_fields_breakdown', function (Blueprint $table) {
            $table->id();
            $table->enum('content_type', ['Left Image List Type', 'Right Image List Type', 'Counter', 'Normal List']);
            $table->integer('content_term_id');
            $table->integer('term_custom_field_id');
            $table->string('content_title');
            $table->string('content_sub_title')->nullable();
            $table->string('content_image')->nullable();
            $table->string('font_awesome')->nullable();
            $table->longText('content_details')->nullable();
            $table->string('content_short_details')->nullable();
            $table->string('content_zone')->nullable();
            $table->integer('sorting_order')->nullable();
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
        Schema::dropIfExists('term_custom_fields_breakdown');
    }
}
