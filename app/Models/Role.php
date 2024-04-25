<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'code',
        'type'
    ];

    /**
     * @param $role_id pass role id to get role name
     * @return role name
     */
    public static function name($role_id)
    {
        return Role::where('id', $role_id)->first()->name ?? Null;
    }
}
