<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalcInputType;
use Illuminate\Http\Request;

class CalcInputTypeController extends Controller
{
    /**
     * @var CalcInputType
     */
    private $calcInputType;

    /**
     * @param CalcInputType $calcInputType
     */
    public function __construct(CalcInputType $calcInputType)
    {

        $this->calcInputType = $calcInputType;
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $check = $this->Model('CalcInputType')::where('attr_id', $request->attr_id)->first();
        $attributes = [
            'setting_type' => 'calcbasic',
            'service_id' => $request->service_id,
            'attr_id' => $request->attr_id,
            'input_type' => $request->input_type,
            'radio_design' => $request->radio_design,
            'input_icon' => $request->input_icon
        ];

//        dd($attributes);

        if ($check) {
            $this->calcInputType::where('id', $check->id)->update($attributes);
        } else {
            $this->calcInputType::create($attributes);
        }

        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Saved']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
        }
    }
}
