<?php

namespace App\Helpers;

use DB;
use Illuminate\Routing\Controller;
use App\Helpers\ButtonSet;
use Illuminate\Http\Request;
use App\Http\Traits\GlobalTrait;

class Datatable
{


    use GlobalTrait;


    /**
     * Datatable Get Data
     * use Api
     * @param $request = Get All Form Input Request
     *
     * @param $query = Set Query Base on Database What you want data
     * During Pass Query As Parameter skip this method ( get(), offset(), limit())
     * Use query() instead of get() in $query
     *
     * @param $field = Which fields you want to show  from Query (Serialize Recommended)
     * Pass fields as Array
     */


    public static function generate($request, $query, $field, $options = [])
    {

        $fields = [];

        $customColumnFilter = [
            'daterange' => 'created_at',
            'phpcode' => null,
        ];

        $merge_arr = array_replace($customColumnFilter, $options);

        //get array keys from $field array;

        foreach (array_keys($field) as $key) {

            $q = $query->get()->toArray();
            $check = array_key_exists($key, $q[0]);
            if ($check == true && is_array($q[0][$key])) {

                $fields [] = 'id';

            } elseif ($check == true) {

                $fields [] = $key;

            } else {
                $fields [] = 'id';
            }

        }

        $start = $request->start ?? 0; //Start show data from request count
        $length = $request->length ?? 50; //How much show data
        $search = $request->search['value'] ?? Null; //Search field
        $column = $request->order ? $fields[$request->order[0]['column']] : 'id'; // column Filter
        $dir = $request->order ? $request->order[0]['dir'] : 'asc'; //Order Descending/Ascending

        //Daterange
        $from_date = date($request->from_date);
        $to_date = date($request->to_date);

        //Total Row Number of Query
        $countTotal = count($query->get());

        if (!empty($search)) { //For Search

            foreach ($fields as $i => $d) {

                $collection = $query->orWhere($d, 'LIKE', '%' . $search . '%')->orderBy($column, $dir)->get();
            }

        } elseif ($request->from_date && $request->to_date) { //For Daterange
            //dd($request->from_date);
            $collection = $query
                ->WhereBetween($merge_arr['daterange'], [$request->from_date, $request->to_date])
                ->orWhereDate($merge_arr['daterange'], [$request->from_date, $request->to_date])
                ->get();

            $countTotal = count($collection);
        } elseif ($request->length == '-1') { //Show all page

            $collection = $query->orderBy($column, $dir)->get();

        } else { //Default

            $collection = $query->orderBy($column, $dir)->offset($start)->limit($length)->get();

        }


        $arr = [];


        foreach ($collection as $key => $data) {

            eval(' ' . $merge_arr["phpcode"] . ';');

            //Evaluted Field
            $val = [];
            foreach ($field as $k => $f) {
                $val[$k] = eval('return ' . $f . ';');
            }
            $arr [] = $val;
        }


        $draw_val = $request->draw;

        $results = array(
            "draw" => intval($draw_val),
            "recordsTotal" => intval($countTotal),
            "recordsFiltered" => intval($countTotal),
            "data" => $arr,
        );
        return $results;

    }//End

    public static function textLimit($param, $limit)
    {
        // strip tags to avoid breaking any html
        $string = strip_tags($param);
        if (strlen($string) > $limit) {

            // truncate string
            $stringCut = substr($string, 0, $limit);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            //$string .= '... <a href="/this/story">Read More</a>';
            return $string;
        }
    }


}
