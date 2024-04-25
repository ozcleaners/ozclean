<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalcBasicSetting;
use Illuminate\Http\Request;

class CalculatorSettingController extends Controller
{
    /**
     * @var CalcBasicSetting
     */
    private $calcBasicSetting;

    public function __construct(CalcBasicSetting $calcBasicSetting)
    {
        $this->calcBasicSetting = $calcBasicSetting;
    }

    public function index()
    {
        return view('admin.common.terms.calculator.index');
    }

    public function store(Request $request)
    {
        //dump($request);
        $attributes = [
            'service_id' => $request->service_id,
            'service_slug' => $request->service_slug,
            'service_icon' => $request->service_icon,
            'setting_type' => $request->setting_type,
            'setting_title' => $request->setting_title,
            'equation_type' => $request->equation_type,
            'rate' => $request->rate,
            'show_on_calculator' => $request->show_on_calculator,
            'computable' => $request->computable,
            'which_module' => $request->which_module,
            'section_id' => $request->section_id ?? NULL,
            'intial_selected' => $request->intial_selected ?? 'No',
            'calculate_with' => $request->calculate_with ?? NULL,
        ];
        //dd($attributes);
        $this->calcBasicSetting::create($attributes);
        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Added']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $section_id = $request->get('section_id');
        $setting = $this->calcBasicSetting->where('id', $section_id)->where('service_id', $id)->first();
        if ($setting) {
            return view('admin.common.terms.calculator.index')->with(['setting' => $setting]);
        } else {
            return redirect()->route('404');
        }
    }


    public function update(Request $request)
    {
//        dd($request->all());
        $attributes = [
            'service_id' => $request->service_id,
            'service_slug' => $request->service_slug,
            'service_icon' => $request->service_icon,
            'setting_type' => $request->setting_type,
            'setting_title' => $request->setting_title,
            'setting_sub_title' => $request->setting_sub_title,
            'equation_type' => $request->equation_type,
            'rate' => $request->rate,
            'show_on_calculator' => $request->show_on_calculator,
            'computable' => $request->computable,
            'which_module' => $request->which_module,
            'section_id' => $request->section_id ?? NULL,
            'intial_selected' => $request->intial_selected ?? 'No',
            'calculate_with' => $request->calculate_with ?? NULL,
        ];
        $this->calcBasicSetting::where('id', $request->calc_basic_setting_id)->update($attributes);
//        $other = $this->calcBasicSetting::where('service_id', $request->service_id)
//            ->where('setting_type', $request->setting_type)
//            ->where('section_id', $request->section_id)
//            ->where('id', '!=', $request->calc_basic_setting_id)
//            ->update(['intial_selected' => 'No']);
        //dd($other);
        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Updated']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->calcBasicSetting::find($id);
        $data->delete();
        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
    }

    public function list_sorting(Request $request)
    {
        $id = $request->get('id');

        if (!empty($id)) {
            $items = $request->post('item');
            $updatable_array = [];
            foreach ($items as $key => $item) {
                $this->calcBasicSetting::where('id', $item)->where('service_id', $id)->update(['sorting_order' => $key]);
            }
            try {
                return response()->json(['status' => 1, 'message' => 'Successfully sorted']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }
}
