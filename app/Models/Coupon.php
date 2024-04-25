<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'user_id', 'coupon_code', 'coupon_amount', 'start_date', 'end_date', 'coupon_type', 'how_many_uses', 'person_limit_user', 'coupon_min', 'coupon_service', 'allow_type', 'limit_type', 'notes', 'limit_type','allow_type','coupon_service','person_limit_user','coupon_groups', 'up_to','coupon_min', 'is_active'
    ];
}
