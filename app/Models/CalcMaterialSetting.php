<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalcMaterialSetting extends Model
{
    use HasFactory;

    protected $table = "calc_materials_settings";
    protected $fillable = [
        'service_id',
        'section_id',
        'material_title',
        'equation_type',
        'rate',
        'extras_connection'
    ];
}
