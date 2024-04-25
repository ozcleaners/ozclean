<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcInputType extends Model
{
    use HasFactory;

    protected $table = "calc_input_types";
    protected $fillable = [
        'setting_type',
        'service_id',
        'attr_id',
        'input_type',
        'radio_design',
        'input_icon'
    ];


    public static function getByAttrId($attr_id)
    {
        $input_type = CalcInputType::where('attr_id', $attr_id)->first()->input_type ?? NULL;
        if (!empty($input_type)) {
            return AttributeValue::getValueById($input_type);
        } else {
            return NULL;
        }
    }

    public static function getDesignByAttrId($id)
    {
        $radio_design = CalcInputType::where('attr_id', $id)->first()->radio_design ?? NULL;
        if (!empty($radio_design)) {
            return AttributeValue::getValueById($radio_design);
        } else {
            return NULL;
        }
    }

    public static function getAttributeSlug($attr_id)
    {
        $input_type = CalcInputType::where('attr_id', $attr_id)->first()->input_type ?? NULL;
        if (!empty($input_type)) {
            return AttributeValue::getColumnById($input_type)->slug;
        } else {
            return NULL;
        }
    }

    public static function getInputEle($attr_id, $service_id){
        $input_type = CalcInputType::where('attr_id', $attr_id)->where('service_id', $service_id)->first() ?? NULL;
        return $input_type;
    }
}
