<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    use HasFactory;
    protected $table = 'global_settings';
    protected $fillable = [
        'name', 'slogan', 'eshtablished', 'license_code', 'logo', 'header_photo', 'phone', 'order_phone', 'email', 
        'address', 'google_map', 'website', 'analytics', 'chat_box',
        'meta_title', 'meta_description', 'meta_keywords','working_hours', 
        'admin_name','admin_phone', 'admin_email','admin_photo', 
        'facebook_page_id','favicon', 'timezone'
    ];
}