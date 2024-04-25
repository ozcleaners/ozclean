<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'pages';
    protected $fillable = [
        'which_editor', 'user_id', 'title', 'sub_title', 'seo_url', 'author', 'description', 'grapes_description', 'grapes_css',
        'images', 'short_description', 'youtube', 'is_sticky', 'lang', 'template', 'is_active'
    ];
}
