<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermCustomFieldBreakdown extends Model
{
    use HasFactory;

    protected $table = 'term_custom_fields_breakdown';

    protected $fillable = [
        'content_type', 'content_term_id', 'term_custom_field_id', 'content_title', 'content_sub_title', 'content_image', 'font_awesome',
        'content_details', 'content_short_details', 'content_zone', 'sorting_order'
    ];
}
