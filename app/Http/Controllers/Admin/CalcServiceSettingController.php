<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalcServiceSetting;
use Illuminate\Http\Request;

class CalcServiceSettingController extends Controller
{
    /**
     * @var CalcServiceSetting
     */
    private $calcServiceSetting;

    /**
     * @param CalcServiceSetting $calcServiceSetting
     */
    public function __construct(CalcServiceSetting $calcServiceSetting)
    {
        $this->calcServiceSetting = $calcServiceSetting;
    }

    public function index()
    {
        return view('admin.common.terms.calculator.service_index');
    }

    public function store(Request $request)
    {
        $attributes = [
            'service_id' => $request->service_id,
            'service_slug' => $request->service_slug,
            'setting_option_type' => $request->setting_option_type,
            'service_title' => $request->service_title,
            'service_sub_title' => $request->service_sub_title,
            'service_title_slug' => $request->service_title_slug,
            'base_price' => $request->base_price,
            'extra_default' => $request->extra_default,
            'service_icon' => $request->service_icon,
            'minimum_qty' => $request->minimum_qty,
            'maximum_qty' => $request->maximum_qty,
            'minimum_price' => $request->minimum_price,
            'calculation_type' => $request->calculation_type,
            'counter_type' => $request->counter_type,
            'computable' => $request->computable,
            'tooltips_content' => $request->tooltips_content,
            'notes' => $request->notes,
            'material_available' => $request->material_available,
            'storey_available' => $request->storey_available,

            // input type setting
            'input_type' => $request->input_type,
            'radio_design' => $request->radio_design
        ];

        $exists = $this->calcServiceSetting::where('service_id', $request->service_id)->where('service_title_slug', $request->service_title_slug)->get();

        if (count($exists) > 0) {
            return redirect()->back()->with(['status' => 0, 'message' => $request->service_title . ' is already added to the list for this service.']);
        } else {
            $this->calcServiceSetting::create($attributes);
            try {
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Added']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
            }
        }


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $section_id = $request->get('section_id');
        $setting = $this->calcServiceSetting->where('id', $section_id)->where('service_id', $id)->first();
        if ($setting) {
            return view('admin.common.terms.calculator.service_index')->with(['setting' => $setting]);
        } else {
            return redirect()->route('404');
        }
    }


    public function update(Request $request)
    {
        $attributes = [
            'service_id' => $request->service_id,
            'service_slug' => $request->service_slug,
            'setting_option_type' => $request->setting_option_type,
            'service_title' => $request->service_title,
            'service_sub_title' => $request->service_sub_title,
            'service_title_slug' => $request->service_title_slug,
            'base_price' => $request->base_price,
            'extra_default' => $request->extra_default,
            'service_icon' => $request->service_icon,
            'minimum_qty' => $request->minimum_qty,
            'maximum_qty' => $request->maximum_qty,
            'minimum_price' => $request->minimum_price,
            'calculation_type' => $request->calculation_type,
            'counter_type' => $request->counter_type,
            'computable' => $request->computable,
            'tooltips_content' => $request->tooltips_content,
            'notes' => $request->notes,
            'material_available' => $request->material_available,
            'storey_available' => $request->storey_available,

            // input type setting
            'input_type' => $request->input_type,
            'radio_design' => $request->radio_design
        ];
        $this->calcServiceSetting::where('id', $request->calc_service_setting_id)->update($attributes);
        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Updated']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->calcServiceSetting::find($id);
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
                $this->calcServiceSetting::where('id', $item)->where('service_id', $id)->update(['sorting_order' => $key]);
            }
            try {
                return response()->json(['status' => 1, 'message' => 'Successfully sorted']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }
}
