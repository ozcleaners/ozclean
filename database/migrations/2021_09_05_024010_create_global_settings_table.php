<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->string('eshtablished')->nullable();
            $table->string('license_code')->nullable();
            $table->string('logo')->nullable();
            $table->string('header_photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('order_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('google_map')->nullable();
            $table->string('website')->nullable();
            $table->string('analytics')->nullable();
            $table->string('chat_box')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('admin_name')->nullable();
            $table->string('admin_phone')->nullable();
            $table->string('admin_email')->nullable();
            $table->string('admin_photo')->nullable();
            $table->string('facebook_page_id')->nullable();
            $table->string('favicon')->nullable();
            $table->string('timezone')->nullable();
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
        Schema::dropIfExists('global_settings');
    }
}
