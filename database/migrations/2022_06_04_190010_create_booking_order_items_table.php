<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_order_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('general_info_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('auth_user_id')->nullable();
            $table->string('accounts_type');
//            $table->string('label_category');
//            $table->string('service_head');
//            $table->string('head_details');
//            $table->string('counting_type')->comment('Fixed of percentage');
//            $table->string('counting_rate');
            $table->string('service_slug')->nullable();
            $table->string('service_title')->nullable();
            $table->string('service_qty')->nullable();
            $table->string('service_extra_default_price')->nullable();
            $table->string('service_base_price')->nullable();
            $table->string('service_minimum_price')->nullable();
            $table->string('service_postcode_price')->nullable();
            $table->string('service_equation_type')->nullable();
            $table->string('service_amount')->nullable();
            $table->integer('total_order_amount')->nullable();
            $table->timestamps();


            $table->foreign('general_info_id')->references('id')->on('booking_general_information');
            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('zone_id')->references('id')->on('attribute_values');
            $table->foreign('auth_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_order_items');
    }
}
