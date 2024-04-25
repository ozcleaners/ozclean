<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['gallery_for', 'media_id', 'parent_category_id', 'category_id', 'serial', 'caption', 'active'];


    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'media_id');
    }
}
