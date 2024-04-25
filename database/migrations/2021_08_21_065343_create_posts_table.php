<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->enum('which_editor', ['normal', 'grapes']);
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('seo_url')->nullable();
            $table->string('author')->nullable();
            $table->string('categories')->nullable();
            $table->string('images')->nullable();

            $table->longText('description')->nullable();
            $table->longText('grapes_description')->nullable();
            $table->longText('grapes_css')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->mediumText('youtube')->nullable();
            $table->string('brand')->nullable();
            $table->string('phone')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('phone_numbers')->nullable();
            $table->mediumText('address')->nullable();
            $table->longText('tags')->nullable();

            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('shop_type')->nullable();

            $table->string('lang')->nullable()->comment = "English, Bengali or any other language";
            $table->boolean('is_auto_post')->nullable();
            $table->boolean('is_upcoming')->nullable();
            $table->boolean('is_sticky')->nullable();

            $table->boolean('is_active');
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
        Schema::dropIfExists('posts');
    }
}
