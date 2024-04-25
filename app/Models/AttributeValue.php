<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = 'attribute_values';

    protected $fillable = [
        'unique_name', 'values', 'slug', 'status', 'created_at', 'updated_at'
    ];


    //get value use unique name
    public static function getValues($unique_name)
    {
        return AttributeValue::where('unique_name', $unique_name)->get() ?? NUll;
    }

    //get value use unique name
    public static function getValueBySlug($slug)
    {
        return AttributeValue::where('slug', $slug)->first() ?? NUll;
    }

    //get value use id
    public static function getValueById($id = '')
    {
        if ($id) {
            $value = AttributeValue::where('id', $id)->first();
            return $value->value ?? NUll;
        } else {
            return NULL;
        }
    }

    //get value use id
    public static function getColumnById($id = '')
    {
        if ($id) {
            $value = AttributeValue::where('id', $id)->first();
            return $value ?? NUll;
        } else {
            return NULL;
        }
    }

}


