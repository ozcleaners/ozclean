<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrderPayment extends Model
{
    use HasFactory;
    protected $table ='booking_order_payments';
    protected $fillable = [
        'auth_user_id',
        'general_info_id',
        'hash_code',
        'account_type',
        'payment_media',
        'amount',
        'media_token',
        'payment_status',
        'payment_date',
    ];

    public static function getDueAmount($general_info_id, $single_service = null){
        $totalReceivable = BookingOrderPayment::where('general_info_id', $general_info_id)
                                        ->where('account_type', 'Receivable')->get()->sum('amount') ?? 0;
        $totalDiscount =  BookingOrderPayment::where('general_info_id', $general_info_id)
                                    ->where('account_type', 'Discount')->get()->sum('amount') ?? 0;
        $totalReceived = BookingOrderPayment::where('general_info_id', $general_info_id)
                                    ->where('account_type', 'Received')->get()->sum('amount') ?? 0;

        return ($totalReceivable-$totalDiscount)-$totalReceived ?? 0;
    }

    public static function getPaidAmount($general_info_id, $single_service = null){
        $totalReceivable = BookingOrderPayment::where('general_info_id', $general_info_id)
                ->where('account_type', 'Receivable')->get()->sum('amount') ?? 0;
        $totalDiscount =  BookingOrderPayment::where('general_info_id', $general_info_id)
                ->where('account_type', 'Discount')->get()->sum('amount') ?? 0;
        $totalReceived = BookingOrderPayment::where('general_info_id', $general_info_id)
                ->where('account_type', 'Received')->get()->sum('amount') ?? 0;

        return $totalReceived ?? 0;
    }

    public static function getTotalAmount($general_info_id, $single_service = null){
        $totalReceivable = BookingOrderPayment::where('general_info_id', $general_info_id)
                ->where('account_type', 'Receivable')->get()->sum('amount') ?? 0;
        $totalDiscount =  BookingOrderPayment::where('general_info_id', $general_info_id)
                ->where('account_type', 'Discount')->get()->sum('amount') ?? 0;
        $totalReceived = BookingOrderPayment::where('general_info_id', $general_info_id)
                ->where('account_type', 'Received')->get()->sum('amount') ?? 0;

        return ($totalReceivable-$totalDiscount) ?? 0;
    }
}
