<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingGeneralInformation extends Model
{
    use HasFactory;

    protected $table = "booking_general_information";
    protected $fillable = [
        'full_name',
        'hash_code',
        'contact_no',
        'email_address',
        'post_code',
        'service_id',
        'sub_service_id',
        'order_status',
        'address_information'
    ];

    public function order_items(){
        return $this->hasMany('\App\Models\BookingOrderItem', 'general_info_id', 'id');
    }

    public function order_payments(){
        return $this->hasMany('\App\Models\BookingOrderPayment', 'general_info_id', 'id');
    }
}
