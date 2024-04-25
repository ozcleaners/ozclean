<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    use HasFactory;
    protected $table = 'postcodes';
    protected $fillable = ['zone_id', 'postcode'];

    public static function getColumn($id, $column){
        $data = Postcode::where('id', $id)->first();
        return $data->$column ?? null;
    }
}
