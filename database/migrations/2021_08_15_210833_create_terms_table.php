<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->enum('which_editor', ['normal', 'grapes']);
            $table->enum('calculator_template', ['regular', 'breakdown', 'popup'])->nullable();
            $table->string('name');
            $table->string('seo_url')->unique();
            $table->integer('cat_theme')->default(1);
            $table->string('type');
            $table->integer('position')->unique();
            $table->string('cssid')->nullable();
            $table->string('cssclass')->nullable();
            $table->longText('description')->nullable();
            $table->longText('grapes_description')->nullable();
            $table->longText('grapes_css')->nullable();
            $table->text('term_short_description')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('connected_with')->nullable();
            $table->string('page_image')->nullable();
            $table->string('thumb_image')->nullable();
            $table->string('home_image')->nullable();
            $table->string('term_menu_icon')->nullable();
            $table->string('term_menu_arrow')->nullable();
            $table->string('with_sub_menu')->nullable();
            $table->string('sub_menu_width')->nullable();
            $table->integer('column_count')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('banner1')->nullable();
            $table->string('banner2')->nullable();
            $table->string('level_no')->nullable();
            $table->string('onpage_banner')->nullable();
            $table->string('checklist')->nullable()->comment('format: name | link');
            $table->longText('alternative_name')->nullable()->comment('format: name1 | name2');
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
        Schema::dropIfExists('terms');
    }
}
