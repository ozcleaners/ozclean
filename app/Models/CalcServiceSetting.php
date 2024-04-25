<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcServiceSetting extends Model
{
    use HasFactory;

    protected $table = "calc_service_settings";
    protected $fillable = [
        'service_id',
        'service_slug',
        'setting_option_type',
        'service_title',
        'service_sub_title',
        'service_title_slug',
        'base_price',
        'extra_default',
        'service_icon',
        'minimum_qty',
        'maximum_qty',
        'minimum_price',
        'service_option_icon',
        'setting_option_title',
        'calculation_type',
        'counter_type',
        'computable',
        'tooltips_content',
        'notes',
        'material_available',
        'storey_available',
        'input_type',
        'radio_design',
        'sorting_order'
    ];


    public static function getAttributeSlug($input_type)
    {
        if (!empty($input_type)) {
            return AttributeValue::getColumnById($input_type)->slug;
        } else {
            return NULL;
        }
    }
}
