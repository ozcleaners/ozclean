<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouses';
    protected $fillable = [
        'name', 'location', 'code', 'phone', 'email'
    ];


    public function roleUsers(){
        return $this->hasMany('\App\Models\Roleuser', 'warehouse_id', 'id');
    }

    public static function name($warehouse_id){
        return Warehouse::where('id', $warehouse_id)->first()->name ?? Null;
    }
}
