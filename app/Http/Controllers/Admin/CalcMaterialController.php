<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalcMaterialSetting;
use Illuminate\Http\Request;

class CalcMaterialController extends Controller
{
    /**
     * @var CalcMaterialSetting
     */
    private $calcMaterialSetting;

    /**
     * @param CalcMaterialSetting $calcMaterialSetting
     */
    public function __construct(CalcMaterialSetting $calcMaterialSetting)
    {
        $this->calcMaterialSetting = $calcMaterialSetting;
    }

    public function store(Request $request)
    {
        $attributes = [
            'service_id' => $request->service_id,
            'section_id' => $request->section_id,
            'material_title' => $request->material_title,
            'equation_type' => $request->equation_type,
            'rate' => $request->rate,
            'extras_connection' => implode(',', $request->extras_connection)
        ];


        $this->calcMaterialSetting::create($attributes);
        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Added']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $attributes = [
            //'service_id' => $request->service_id,
            //'section_id' => $request->section_id,
            'material_title' => $request->material_title,
            'equation_type' => $request->equation_type,
            'rate' => $request->rate,
            'extras_connection' => implode(',', $request->extras_connection)
        ];

        $this->calcMaterialSetting::where('id', $request->calc_material_setting_id)->update($attributes);
        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Added']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->calcMaterialSetting::find($id);
        $data->delete();
        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
    }
}
