<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('coupon_code')->unique();
            $table->string('coupon_amount');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('coupon_type', ['Percentage', 'Fixed'])->nullable()->comment('percentage/fixed');
            $table->enum('allow_type', ['All', 'Custom'])->nullable()->comment('all/custom');
            $table->enum('limit_type', ['Unlimited', 'Custom'])->nullable()->comment('unlimited/custom');
            $table->string('coupon_service')->nullable();
            $table->string('how_many_uses')->nullable();
            $table->integer('person_limit_user')->nullable();
            $table->string('coupon_min')->nullable();
            $table->longText('notes')->nullable();
            $table->string('coupon_groups')->nullable();
            $table->string('up_to')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
