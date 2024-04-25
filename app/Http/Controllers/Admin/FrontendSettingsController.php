<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontendSettings;
use DB;
use Validator;

class FrontendSettingsController extends Controller
{
    //index
    public function index()
    {
        return view('admin.common.settings.frontend-settings');
    }

    public function store(Request $request)
    {
        $meta_name = strtolower(str_replace(' ', '_', $request->meta_title));
        $arr = [
            'meta_name' => $meta_name,
        ];
        //dd($request->all());
        $validator = Validator::make($arr,
            [
                'meta_name' => 'unique:frontend_settings',
            ]
        );
        //dd($validator->fails());
        // process the login
        if ($validator->fails()) {
            return redirect()->back()
                ->with(['status' => 0, 'message' => 'Meta name should be unique']);
        } else {
            $attribute = [
                'meta_title' => $request->meta_title,
                'meta_value' => $request->meta_value,
                'meta_name' => $meta_name,
                'meta_group' => $request->meta_group,
                'meta_type' => $request->meta_type
            ];

            FrontendSettings::create($attribute);

            return redirect()->back()->with(['status' => 1, 'message' => 'Settings saved successfully']);
        }
    }

    //update
    public function update(Request $request)
    {
//        dd($request->all());
//        $validate = $request->validate([
//            'meta_name' => ['unique:frontend_settings,meta_name', 'meta_name']
////             'meta_name' => 'unique:frontend_settings',
//        ]);

//        if ($validate->fails()) {
//            return redirect()->back()
//                ->withErrors($validate)
//                ->withInput();
//        } else {

            $metaName = $request->meta_name;
            $getAll = FrontendSettings::get();
            //dd($metaName);
            foreach ($metaName as $key => $item) {
                $data = FrontendSettings::where('meta_name', $item)->first();
                if (!empty($data)) {
                    $data->meta_title = $request->meta_title[$key];
                    $data->meta_group = $request->meta_group[$key];
                    $data->meta_value = $request->$item;
                    $data->save();
                } else {
                    return redirect()->back()->with('delete', $request->$item . ' field not found');
                }
            }
            return redirect()->back()->with(['status' => 1, 'message' => 'Settings saved successfully']);

//        }
    }

    // Eta lagbe
    public function get_enum_values($table, $field)
    {
        $type = DB::select(DB::raw('SHOW COLUMNS FROM ' . $table . ' WHERE Field = "' . $field . '"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach (explode(',', $matches[1]) as $value) {
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
