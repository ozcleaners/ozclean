<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_informations', function (Blueprint $table) {
            $table->id();
            $table->enum('content_type', ['Post', 'Page', 'Term']);
            $table->integer('content_id')->comment('It could be post id or page id or term id or any other content id');
            $table->string('meta_zone')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_tags')->nullable();
            $table->string('meta_author')->nullable();
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
        Schema::dropIfExists('seo_informations');
    }
}
