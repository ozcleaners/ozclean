<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->enum('which_editor', ['normal', 'grapes']);
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('sub_title');
            $table->string('seo_url')->nullable();
            $table->string('author')->nullable();
            $table->longText('description')->nullable();

            $table->longText('grapes_description')->nullable();
            $table->longText('grapes_css')->nullable();

            $table->string('images')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->mediumText('youtube')->nullable();

            $table->boolean('is_sticky')->nullable();
            $table->string('lang')->nullable()->comment = "English, Bengali or any other language";
            $table->string('template')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
