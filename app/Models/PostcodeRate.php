<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostcodeRate extends Model
{
    use HasFactory;
    protected $table = 'postcode_rates';
    protected $fillable = [
        'zone_id', 'postcode_id', 'postcode', 'service_id', 'equation_type', 'rate'
    ];

    public function getEquationType(){
        return $this->hasOne('\App\Models\AttributeValue', 'id', 'equation_type');
    }

    public static function getData($service_id, $zone_id, $option =[]){
        $default = [
            'column' => null,
            'postcode_id' => null,
        ];
        $merge = array_merge($default, $option);
        $column = $merge['column'];
        $data = PostcodeRate::where('service_id', $service_id)->where('zone_id', $zone_id);
        if(!empty($merge['column'])){
            if(!empty($merge['postcode_id'])){
                $data = $data->where('postcode_id', $merge['postcode_id']);
            }
            $data =  $data->first()->$column ?? null;

        }else {
            $data =  $data->get() ?? null;
        }
        return $data;

    }
}
