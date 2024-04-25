<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Routelist;

class RoutelistController extends Controller
{

    private $routelist;

    public function __construct(RouteList $routelist)
    {
        $this->routelist = $routelist;
    }

    public function index()
    {
        $routelists = $this->routelist::orderBy('route_group', 'ASC')->get();
        return view('admin.pages.routelists.index', ['routelists' => $routelists]);
    }

    public function create()
    {
        return view('admin.pages.routelists.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'route_name' => 'required',
                'route_title' => 'required',
                'route_description' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('routelists.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'route_name' => $request->route_name,
                'route_title' => $request->route_title,
                'route_hash' => bcrypt($request->route_name),
                'route_group' => $request->route_group,
                'parent_menu_id' => $request->parent_route_id,
                'show_menu' => $request->show_menu,
                'dashboard_position' => implode(',', $request->dashboard_position ?? [Null]),
                'route_icon' => $request->route_icon,
                'route_order' => $request->route_order,
                'route_description' => $request->route_description,
            ];
            $routelist = $this->routelist::create($attributes);
            try {
                return redirect()->route('routelist_index')->with(['status' => 1, 'message' => 'Successfully created']);
            } catch (\Exception $e) {
                return redirect()->route('routelist_create')->with(['status' => 0, 'message' => 'Error']);
            }
        }
    }


    public function edit($id)
    {
        $routelist = $this->routelist::find($id);
        return view('admin.pages.routelists.form', ['routelist' => $routelist]);
    }


    public function update(Request $request)
    {
        // store
        $attributes = [
            'route_name' => $request->route_name,
            'route_title' => $request->route_title,
            'route_hash' => bcrypt($request->route_name),
            'route_group' => $request->route_group,
            'parent_menu_id' => $request->parent_route_id,
            'show_menu' => $request->show_menu,
            'dashboard_position' => implode(',', $request->dashboard_position ?? [Null]),
            'route_icon' => $request->route_icon,
            'route_order' => $request->route_order,
            'route_description' => $request->route_description,
        ];

        try {
            $routelist = $this->routelist::where('id', $request->id)->update($attributes);
            return redirect()->route('routelist_index')->with(['status' => 1, 'message' => 'Successfully updated']);
        } catch (\Exception $e) {
            return redirect()->route('routelist_edit', $request->id)->with(['status' => 0, 'message' => 'Error']);
        }
    }


    public function destroy($id)
    {
        $routelist = $this->routelist::find($id);
        $routelist->delete();
        return redirect()->route('routelist_index', ['status' => 1, 'message' => 'Successfully deleted']);
    }


    /**
     * Api method
     *
     */
    public function apiGet(Request $request)
    {
        //dd($request->all());


        $from_date = date($request->from_date);
        $to_date = date($request->to_date);
        //dd($from_date);
        $test = $this->routelist::whereBetween('created_at', ['2021-08-02', '2021-08-08'])
            ->orWhereBetween('updated_at', ['2021-08-02', '2021-08-08'])
            ->get();
        $make = [
            'id',
            'route_title',
            'route_name',
            'route_group',
            'route_description',
            'route_order',
            'show_menu',
            'dashboard_position'
        ];

        $start = $request->start ?? 0;
        $length = $request->length ?? 50;
        $search = $request->search['value'] ?? Null;
        $column = $request->order ? $make[$request->order[0]['column']] : 'id';
        $dir = $request->order ? $request->order[0]['dir'] : 'asc';
        //dd($column);
        if (!empty($search)) {
            foreach ($make as $key => $m) {
                $routelist = $this->routelist::where($make[2], 'LIKE', '%' . $search . '%')->orWhere($m, 'LIKE', '%' . $search . '%')->orderBy($column, $dir)->offset($start)->limit($length)->get();
            }
        } elseif ($request->length == '-1') {
            $routelist = $this->routelist::orderBy($column, $dir)->get();
        } else {
            $routelist = $this->routelist::orderBy($column, $dir)->offset($start)->limit($length)->get();
        }
        //dd($routelist);
        $arr = [];
        $countTotal = count($this->routelist::get());
        foreach ($routelist as $data) {
            $editButton = $this->ButtonSet::edit('routelist_edit', $data->id);
            $deleteButton = $this->ButtonSet::delete('routelist_destroy', $data->id);

            $arr [] = [
                'button' => $deleteButton . $editButton,
                'route_title' => $data->route_title,
                'route_name' => $data->route_name,
                'route_group' => $this->Query::accessModel('Routegroup')::name($data->route_group),
                'route_description' => $data->route_description,
                'route_order' => $data->route_order,
                'show_menu' => $data->show_menu,
                'dashboard_position' => $data->dashboard_position,
            ];
        }

        $draw_val = $request->draw;

        $results = array(
            "draw" => intval($draw_val),
            "recordsTotal" => intval($countTotal),
            "recordsFiltered" => intval($countTotal),
            "data" => $arr,
        );
        return $results;
    }
}
