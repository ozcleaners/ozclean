<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $fillable = [
        'name', 'position', 'cssid', 'cssclass', 'description', 'albums_pcat_id', 'special', 'is_active'
    ];
}
