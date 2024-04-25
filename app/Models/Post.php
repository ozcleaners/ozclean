<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'which_editor', 'user_id', 'title', 'sub_title', 'seo_url', 'author', 'description', 'categories', 'images', 'brand', 'tags', 'youtube', 'is_auto_post', 'short_description', 'is_upcoming', 'phone', 'opening_hours', 'latitude', 'longitude', 'phone_numbers', 'address', 'is_sticky', 'division', 'district', 'thana', 'shop_type', 'lang',
        'offer_expire_date', 'position', 'font_awesome_icon', 'is_active', 'created_at'
    ];

    public static function category($category_id)
    {
        if (!empty($category_id)) {
            return Post::whereRaw("FIND_IN_SET($category_id, categories)");
        } else {
            return null;
        }
    }

    public static function getCat($post_id){
        $data = Post::where('id', $post_id)->first()->categories ?? null;
        if($data){
            $cat = explode(',', $data);
            return $cat[0];
        }
    }


}
