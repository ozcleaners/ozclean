<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcBasicSetting extends Model
{
    use HasFactory;

    protected $table = "calc_basic_settings";
    public $timestamps = true;
    protected $fillable = [
        'service_id',
        'service_slug',
        'service_icon',
        'setting_type',
        'setting_title',
        'setting_sub_title',
        'equation_type',
        'rate',
        'show_on_calculator',
        'computable',
        'sorting_order',
        'which_module',
        'section_id',
        'intial_selected',
        'calculate_with',
    ];

    public function equationType()
    {
        return $this->hasOne('\App\Models\AttributeValue', 'id', 'equation_type');
    }
}
