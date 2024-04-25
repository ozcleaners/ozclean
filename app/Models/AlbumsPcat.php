<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumsPcat extends Model
{
    protected $table = 'albums_pcat';
    protected $fillable = [
        'name', 'cover_photo', 'is_active'
    ];
}
