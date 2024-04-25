<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = [
        'original_name', 'filename', 'file_type', 'file_size', 'file_extension', 'full_size_directory', 'icon_size_directory', 'status', 'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @param $id We will pass the image ID here to get the icon Size Photo of an image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public static function iconSize($id)
    {
        $get = Media::where('id', $id)->first();
        if ($get) {
            return url($get->icon_size_directory) ?? Null;
        } else {
            return Null;
        }

    }

    /**
     * @param $id We will pass the image ID here to get the Full Size Photo of an image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public static function fullSize($id)
    {
        $get = Media::where('id', $id)->first();
        if ($get) {
            return url($get->full_size_directory) ?? Null;
        } else {
            return Null;
        }
    }

    public static function isLandsape($file)
    {

            if($file) {
               if(is_file($file)) {
                   list($width, $height) = getimagesize($file);
                   return $width > $height;
               }else {
                    return null;
               }
            }else {
                return null;
            }

    }
}
