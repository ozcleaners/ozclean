<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeCard extends Model
{
    use HasFactory;

    protected $table = 'stripe_cards';

    protected $fillable = [
        'user_id', 'stripe_user_id', 'order_master_id',
    ];
}
