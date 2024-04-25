<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermCustomFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->enum('content_for', ['Term', 'Post'])->nullable();
            $table->integer('content_term_id');
            $table->integer('content_term_parent_id');
            $table->enum('content_type', ['Tabs', 'Text', 'Multiple Image', 'Bullets Vertical', 'Bullets Horizontal', 'Special Text', 'Vertical Tabs']);
            $table->string('content_title');
            $table->string('content_seo_url')->nullable();
            $table->string('content_sub_title')->nullable();
            $table->string('content_image')->nullable();
            $table->integer('content_page_banner')->nullable();
            $table->longText('content_details')->nullable();
            $table->string('content_short_details')->nullable();
            $table->string('content_zone')->nullable();
            $table->integer('sorting_order')->nullable();
            $table->string('bg_color')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->nullable();
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
        Schema::dropIfExists('term_custom_fields');
    }
}
