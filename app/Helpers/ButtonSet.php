<?php

namespace App\Helpers;

use DB;
use App\Helpers\Query;

class ButtonSet
{

    //Current user role
    public static function crole()
    {
        return auth()->user()->getUserRole();
    }

    //View Button
    public static function view($route_name, $id)
    {
        //Check Route If have this user role is pernitted
        if (auth()->user()->checkUserRoleTypeGlobal() == true) {
            $check = true;
        } else {
            $check = auth()->user()->checkRoute(Self::crole(), $route_name);
        }
        if (!empty($check)) {
            $link = route($route_name, $id);
            $html = '<a class="view" href="' . $link . '" title="View">';
            $html .= '<span class="icon-eye"></span>';
            $html .= '</a>';
            return $html;
        }
    }

    //Edit Button
    public static function edit($route_name, $id)
    {
        //Check Route If have this user role is pernitted
        if (auth()->user()->checkUserRoleTypeGlobal() == true) {
            $check = true;
        } else {
            $check = auth()->user()->checkRoute(Self::crole(), $route_name);
        }

        if (!empty($check)) {
            $link = route($route_name, $id);
            $html = '<a class="edit" href="' . $link . '" title="Edit">';
            $html .= '<span class="icon-edit"></span>';
            $html .= '</a>';
            return $html;
        }
    }

    /**
     * @param $route_name ডিলেট করার জন্য রাউট নাম
     * @param $id কোন রো ডিলেট করতে চাই সেই আইডি
     * @return string|void ভয়েড ফরমেটে ভ্যালু রিটার্ন করবে
     */
    public static function delete($route_name, $id, $option =[])
    {
        $default = [
            'title' => null,
        ];
        $merge = array_merge($default, $option);
        if (auth()->user()->checkUserRoleTypeGlobal() == true) {
            $check = true;
        } else {
            $check = auth()->user()->checkRoute(Self::crole(), $route_name);
        }

        if (!empty($check)) {
            $html = '<a class="delete d-inline-block" title="Delete">';
            $html .= Query::delete($route_name, $id, ['title' => $merge['title']]);
            $html .= '</a>';
            return $html;
        }
    }
}
