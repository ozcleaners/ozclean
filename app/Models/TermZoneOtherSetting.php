<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermZoneOtherSetting extends Model
{
    use HasFactory;
    protected  $table = 'term_zone_other_settings';
    protected $fillable = ['zone_id', 'service_id', 'setting_name', 'setting_value'];


    public static function getValue($service_id, $zone_id, $setting_name){
        $data = TermZoneOtherSetting::where('service_id', $service_id)->where('zone_id', $zone_id)->where('setting_name', $setting_name)->first();
        return $data->setting_value ?? null;
    }
}
