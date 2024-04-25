<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrderItem extends Model
{
    use HasFactory;

    protected $table = "booking_order_items";
    protected $fillable = [
        'general_info_id',
        'hash_code',
        'service_id',
        'sub_service_id',
        'zone_id',
        'auth_user_id',
        'accounts_type',
        'service_slug',
        'service_title',
        'service_qty',
        'service_extra_default_price',
        'service_base_price',
        'service_equation_type',
        'service_minimum_price',
        'service_postcode_price',
        'service_amount'
    ];
}
