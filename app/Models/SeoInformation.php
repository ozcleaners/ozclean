<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoInformation extends Model
{
    use HasFactory;

    protected $table = 'seo_informations';

    protected $fillable = [
        'content_type',
        'content_id',
        'meta_zone',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_tags',
        'meta_author'
    ];
}
