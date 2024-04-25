<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Term extends Model
{
    use HasFactory;

    protected $table = 'terms';
    protected $fillable = [
        // Required
        'which_editor', 'calculator_template', 'name', 'term_subtitle', 'seo_url', 'type', 'position', 'description',
        'grapes_description', 'grapes_css', 'term_short_description', 'parent', 'level_no', 'connected_with',
        // Optional
        'cssid', 'cssclass', 'cat_theme', 'page_image', 'home_image', 'term_menu_icon', 'term_menu_arrow', 'checklist', 'alternative_name', 'with_sub_menu',
        'sub_menu_width', 'banner1', 'banner2', 'column_count', 'thumb_image', 'onpage_banner'
    ];

    public function sub_categories()
    {
        return $this->hasMany(Term::class, 'parent', 'id');
    }

    public static function getContent($id)
    {
        return Term::where('id', $id)->first() ?? Null;
    }

    /**
     * @param $value We will put the category ids getting from posts table
     * @return string It will return comman separated names of category
     * @example getNames($ids) eg. getNames('64,65,67')
     */
    public static function getNames($value)
    {
        $got_array = explode(',', $value);
        $returnable_array = [];
        foreach ($got_array as $key => $val) {
            $returnable_array[] = Term::where('id', $val)->first()->name ?? NULL;
        }

        return implode(',', $returnable_array);

    }

    /**
     * @param $id row number
     * @param $column_name which column would we like to pull?
     * @return mixed String value based on column name
     */
    public static function getColumn($id, $column_name)
    {
        $term = Term::where('id', $id)->first();
        if ($term) {
            return $term->$column_name;
        } else {
            return null;
        }
    }

    public static function getColumnById($seo_url, $column_name)
    {
        $term = Term::where('seo_url', $seo_url)->first();
        if ($term) {
            return $term->$column_name;
        } else {
            return null;
        }
    }

    /**
     * Services
     */
    public function getCustomFieldTerm()
    {
        return $this->hasMany('App\Models\TermCustomField', 'id', 'content_term_id');
    }

    public function getSubCategory()
    {
        return $this->hasMany('App\Models\Term', 'parent', 'id')->with('getSubCategory')->with('getSubCategory');
    }

    public static function serviceCat($id = 3)
    {

        $zones = AttributeValue::where('unique_name', 'Zone')->where('status', 'Active')->get();
        $mainSubs = Term::where('parent', 3)->get();

        $subTerm = function ($id) {
            return Term::where('parent', $id)->get();
        };

//, DB::raw("LOWER(REPLACE(content_title, ' ', '_') AS content_title_seo_url")
        $arr = [];
        foreach ($zones as $zone) {
            $zone_name = $zone->value;
            /** Onek Birokto korsilo... mone rakhlam... future a lagle kopamu
             *
             * $term = function ($zone_name) {
             * return TermCustomField::leftJoin('terms', 'terms.id', 'term_custom_fields.content_term_id')
             * ->select('content_term_id', 'content_title', 'content_seo_url', 'terms.parent', 'content_image', DB::raw('REPLACE(LOWER(`content_title`), " ", "-") AS lower_content_title'))
             * ->where('content_zone', $zone_name)
             * //->where('content_type', 'Term Title')
             * ->get()
             * ->groupBy('content_term_id')
             * ->toArray();
             * };
             *
             *
             * $sub_terms = function ($id) {
             * return Term::select('name', 'seo_url', 'position', 'thumb_image')
             * ->where('parent', $id)
             * ->get()
             * ->toArray();
             * };
             *
             * **/

            $zone_wise_service_title = function ($term_id, $zone_name) {
                return TermCustomField::select('content_title', 'content_seo_url', 'content_image', 'content_term_id', 'content_term_parent_id')
                    ->where('content_term_parent_id', $term_id)
                    ->where('content_zone', $zone_name)
                    ->where('content_type', 'Term Title')
                    ->get()
                    ->toArray();
            };

            foreach ($mainSubs as $k => $v) {
                $arr[$zone_name][$v->id]['seo_url'] = $v->seo_url;
                $arr[$zone_name][$v->id]['name'] = $v->name;
                $arr[$zone_name][$v->id]['how_many_sections_under_this_zone'] = TermCustomField::where('content_zone', $zone_name)->get()->count();
                $arr[$zone_name][$v->id]['zone_name'] = $zone_name;
                $arr[$zone_name][$v->id]['zone_id'] = $zone->id;
                $arr[$zone_name][$v->id]['zone_lowercase_name'] = strtolower($zone_name);
                //$arr[$zone_name][$v->id]['content_term_ids'] = $term($zone_name);
                //$arr[$zone_name][$v->id]['sub_terms'] = $sub_terms($v->id);
                $arr[$zone_name][$v->id]['zone_wise_content_title'] = $zone_wise_service_title($v->id, $zone_name);
            }

        }

        return $arr;
    }

    public static function getChildsByCategoryId($option = [])
    {
        $arr = [
            'term_id' => 34,
            'parent_parent_id' => 7,
            'parent_parent_parent_id' => 3
        ];

        $var = array_merge($arr, $option);
        $parentParentCategoryId = Term::where('id', $var['parent_parent_id'])->first()->parent ?? NULL;
        if (!empty($parentParentCategoryId) && ($parentParentCategoryId == $var['parent_parent_parent_id'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
