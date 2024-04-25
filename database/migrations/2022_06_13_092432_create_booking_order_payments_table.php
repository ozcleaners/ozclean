<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_order_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auth_user_id');
            $table->unsignedBigInteger('general_info_id');
            $table->string('hash_code');
            $table->enum('account_type', ['Receivable', 'Received', 'Discount'])->nullable();
            $table->enum('payment_media', ['Stripe', 'Paypal', '2checkout', 'Other'])->nullable();
            $table->double('amount');
            $table->string('media_token')->nullable();
            $table->enum('payment_status', ['Partial', 'Full'])->nullable();
            $table->dateTime('payment_date')->nullable();
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
        Schema::dropIfExists('booking_order_payments');
    }
}
