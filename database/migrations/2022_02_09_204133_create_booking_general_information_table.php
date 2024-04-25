<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingGeneralInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_general_information', function (Blueprint $table) {
            $table->id();
            $table->string('hash_code');
            $table->string('full_name');
            $table->string('contact_no')->nullable();
            $table->string('email_address');
            $table->string('post_code');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('sub_service_id')->nullable();
            $table->enum('order_status', ['Recieved', 'Placed', 'Processing', 'Distribution', 'Done'])->nullable();
            $table->enum('payment_status', ['Paid', 'Partial', 'Pending'])->nullable();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('terms');
            $table->foreign('sub_service_id')->references('id')->on('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_general_information');
    }
}
