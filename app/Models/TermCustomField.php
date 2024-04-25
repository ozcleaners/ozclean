<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermCustomField extends Model
{
    use HasFactory;

    protected $table = 'term_custom_fields';

    protected $fillable = [
        'content_for', 'content_term_id', 'content_term_parent_id', 'content_type', 'content_title',
        'content_seo_url', 'content_sub_title', 'content_image', 'content_page_banner', 'content_details',
        'content_short_details', 'content_zone', 'sorting_order', 'bg_color', 'is_active'
    ];
}
