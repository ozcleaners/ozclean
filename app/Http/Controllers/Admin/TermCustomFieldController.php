<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PostCodeImport;
use App\Models\TermZoneOtherSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TermCustomField;
use App\Models\TermCustomFieldBreakdown;
use App\Models\Term;
use App\Models\SeoInformation;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class TermCustomFieldController extends Controller
{
    private $termcustomfield;
    private $termcustomfieldbreakdown;
    private $seo_information;

    /**
     * @param TermCustomField $termcustomfield
     * @param TermCustomFieldBreakdown $customfieldbreakdown
     * @param SeoInformation $seoInformation
     */
    public function __construct(TermCustomField $termcustomfield, TermCustomFieldBreakdown $customfieldbreakdown, SeoInformation $seoInformation)
    {
        $this->termcustomfield = $termcustomfield;
        $this->customfieldbreakdown = $customfieldbreakdown;
        $this->seo_information = $seoInformation;
    }

    public function index()
    {

    }


    public function custom_field_store(Request $request)
    {
        //dd($request);
        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'content_term_id' => 'required',
                'content_type' => 'required',
                'content_title' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $getLastSortOrder = $this->termcustomfield->select('sorting_order')->where('content_term_id', $request->get('content_term_id'))
                ->orderBy('sorting_order', 'desc')->first();
            $number = $getLastSortOrder->sorting_order ?? 0;
            // store
            $attributes = [
                'content_for' => 'Term',
                'content_term_id' => $request->get('content_term_id'),
                'content_term_parent_id' => Term::where('id', $request->get('content_term_id'))->first()->parent ?? NULL,
                'content_type' => $request->get('content_type'),
                'content_title' => $request->get('content_title'),
                'content_seo_url' => $request->get('content_seo_url'),
                'content_sub_title' => $request->get('content_sub_title'),
                'content_image' => $request->get('content_image'),
                'content_page_banner' => $request->get('content_page_banner'),
                'content_details' => $request->get('content_details'),
                'content_short_details' => $request->get('content_short_details'),
                'content_zone' => $request->get('content_zone'),
                'sorting_order' => $number + 1,
                'bg_color' => $request->get('bg_color'),
                'is_active' => $request->get('is_active')
            ];

            //dd($attributes);
            try {
                $done = $this->termcustomfield->create($attributes);
                //dd($done);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function edit(Request $request, $id)
    {

        $termcustomfield = $this->termcustomfield::where('id', $request->get('section_id'))->first();
        return view('admin.common.terms.term_rich_content')
            ->with('termcustomfield', $termcustomfield);

    }

    public function update(Request $request)
    {
        //dd($request);
        $d = $this->termcustomfield::find($request->content_id);
        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'content_id' => 'required',
                'content_type' => 'required',
                'content_title' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'content_type' => $request->get('content_type'),
                'content_title' => $request->get('content_title'),
                'content_seo_url' => $request->get('content_seo_url'),
                'content_sub_title' => $request->get('content_sub_title'),
                'content_image' => $request->get('content_image'),
                'content_page_banner' => $request->get('content_page_banner'),
                'content_details' => $request->get('content_details'),
                'content_short_details' => $request->get('content_short_details'),
                'content_zone' => $request->get('content_zone'),
                'bg_color' => $request->get('bg_color'),
                'is_active' => $request->get('is_active')
            ];

            try {
                $done = $this->termcustomfield::where('id', $d->id)->update($attributes);
                //dd($done);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        $mm = $this->termcustomfield->find($id);
        $mm->delete();
        $this->customfieldbreakdown->where('term_custom_field_id', $id)->delete();

        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function sorting(Request $request)
    {
        $id = $request->get('id');

        if (!empty($id)) {
            $items = $request->post('item');

            $updatable_array = [];
            foreach ($items as $key => $item) {
                //$updatable_array[] = $item;
                //dump($item);
                $this->termcustomfield::where('id', $item)->where('content_term_id', $id)->update(['sorting_order' => $key]);
            }

            try {
                return response()->json(['status' => 1, 'message' => 'Successfully sorted']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }

    }

    public function copy_content_form($id)
    {

        $categories = Term::get()->toArray();
        return view('admin.common.terms.copy_content_form')->with(['cats' => $categories]);
    }

    public function copy_content(Request $request)
    {
        //dd($request->all());

        $copy_to_parent = Term::where('id', $request->copy_to)->first()->parent;
        $dataD = TermCustomField::where('content_term_id', $request->copy_to)->where('content_term_parent_id', $copy_to_parent);
        $dataD->delete();

        if ($request->from_id) {
            $all_contents = $this->termcustomfield::where('content_term_id', $request->from_id)->get();
        }
        foreach ($all_contents as $key => $row) {
            $breakdown_contents = $this->customfieldbreakdown::where('term_custom_field_id', $row->id)->get();
            $data = new TermCustomField();
            $data->content_for = 'Term';
            $data->content_term_id = $request->copy_to;
            $data->content_term_parent_id = $copy_to_parent; //$row->content_term_parent_id;
            $data->content_type = $row->content_type;
            $data->content_title = $row->content_title;
            $data->content_seo_url = $row->content_seo_url; //. 'copy-' . bin2hex(random_bytes(4));
            $data->content_sub_title = $row->content_sub_title;
            $data->content_image = $row->content_image;
            $data->content_page_banner = $row->content_page_banner;
            $data->content_details = $row->content_details;
            $data->content_short_details = $row->content_short_details;
            $data->content_zone = $row->content_zone;
            $data->sorting_order = $row->sorting_order;
            $data->bg_color = $row->bg_color;
            $data->is_active = $row->is_active;
            $data->created_at = $row->created_at;
            $data->updated_at = $row->updated_at;
            $data->save();


            if (count($breakdown_contents) > 0) {
                foreach ($breakdown_contents as $k => $bc) {
                    $d = new TermCustomFieldBreakdown();
                    $d->content_term_id = $request->copy_to;
                    $d->content_type = $bc->content_type;
                    $d->term_custom_field_id = $data->id; //$bc->content_term_parent_id;
                    $d->content_title = $bc->content_title;
                    $d->content_sub_title = $bc->content_sub_title;
                    $d->content_image = $bc->content_image;
                    $d->font_awesome = $bc->font_awesome;
                    $d->content_details = $bc->content_details;
                    $d->content_short_details = $bc->content_short_details;
                    $d->content_zone = $bc->content_zone;
                    $d->sorting_order = $bc->sorting_order;
                    $d->created_at = $bc->created_at;
                    $d->updated_at = $bc->updated_at;
                    //dd($d);
                    $d->save();
                }
            }


        }

        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully copied']);
        } catch (\Exception $e) {
            //dd($e->errorInfo[2]);
            $errormsg = $e->errorInfo[2];
        }
    }


    public function copy_zone_content(Request $r){
//        dd($r->all());
        $copy_to_parent = Term::where('id', $r->term_id)->first()->parent;
        $datas = TermCustomField::where('content_for', 'Term')
                            ->where('content_term_id', $r->term_id)
                            ->where('content_term_parent_id', $copy_to_parent)
                            ->where('content_zone', $r->from_zone)
                            ->get();

        foreach ($datas as $key => $row) {
            $breakdown_contents = $this->customfieldbreakdown::where('term_custom_field_id', $row->id)->get();
            $data = new TermCustomField();
            $data->content_for = 'Term';
            $data->content_term_id = $row->content_term_id;
            $data->content_term_parent_id = $row->content_term_parent_id; //$row->content_term_parent_id;
            $data->content_type = $row->content_type;
            $data->content_title = $row->content_title;
            $data->content_seo_url = $row->content_seo_url; //. 'copy-' . bin2hex(random_bytes(4));
            $data->content_sub_title = $row->content_sub_title;
            $data->content_image = $row->content_image;
            $data->content_page_banner = $row->content_page_banner;
            $data->content_details = $row->content_details;
            $data->content_short_details = $row->content_short_details;
            $data->content_zone = $r->copy_to_zone;
            $data->sorting_order = $row->sorting_order;
            $data->bg_color = $row->bg_color;
            $data->is_active = $row->is_active;
            $data->created_at = $row->created_at;
            $data->updated_at = $row->updated_at;
            $data->save();


            if (count($breakdown_contents) > 0) {
                foreach ($breakdown_contents as $k => $bc) {
                    $d = new TermCustomFieldBreakdown();
                    $d->content_term_id = $bc->content_term_id;
                    $d->content_type = $bc->content_type;
                    $d->term_custom_field_id = $data->id; //$bc->content_term_parent_id;
                    $d->content_title = $bc->content_title;
                    $d->content_sub_title = $bc->content_sub_title;
                    $d->content_image = $bc->content_image;
                    $d->font_awesome = $bc->font_awesome;
                    $d->content_details = $bc->content_details;
                    $d->content_short_details = $bc->content_short_details;
                    $d->content_zone = $r->copy_to_zone;
                    $d->sorting_order = $bc->sorting_order;
                    $d->created_at = $bc->created_at;
                    $d->updated_at = $bc->updated_at;
                    //dd($d);
                    $d->save();
                }
            }

        }

        return redirect()->route('common_term_custom_field_edit', ['id' =>$r->term_id, 'zone' => $r->copy_to_zone])->with(['status' => 1, 'message' => 'Successfully copied']);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * =====================================
     * Custom field breakdown of a section
     *======================================
     */

    public function breakdown_add_form()
    {
        return view('admin.common.terms.custom_field_breakdown');
    }

    public function custom_field_breakdown_store(Request $request)
    {
        //dd($request);
        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'content_term_id' => 'required',
                'term_custom_field_id' => 'required',
                'content_title' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $getLastSortOrder = $this->customfieldbreakdown->select('sorting_order')->where('term_custom_field_id', $request->get('term_custom_field_id'))
                ->orderBy('sorting_order', 'desc')->first();
            $number = $getLastSortOrder->sorting_order ?? 0;
            $attributes = [
                'content_type' => $request->get('content_type'),
                'content_term_id' => $request->get('content_term_id'),
                'term_custom_field_id' => $request->get('term_custom_field_id'),
                'content_title' => $request->get('content_title'),
                'content_sub_title' => $request->get('content_sub_title'),
                'content_image' => $request->get('content_image'),
                'font_awesome' => $request->get('font_awesome'),
                'content_details' => $request->get('content_details'),
                'content_short_details' => $request->get('content_short_details'),
                'content_zone' => $request->get('content_zone'),
                'sorting_order' => $number + 1
            ];

            //dd($attributes);
            try {
                $done = $this->customfieldbreakdown->create($attributes);
                //dd($done);
                $r = url("/") . "/admin/common/term/custom_field_breakdown_edit/" . $request->content_term_id . "?zone=" . request()->get('zone') . "&custom_field_id=" . $request->term_custom_field_id;
                return redirect($r)->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function breakdown_edit(Request $request, $id)
    {
        $customfieldbreakdown = $this->customfieldbreakdown::where('id', $request->get('custom_field_breakdown_id'))->first();
        return view('admin.common.terms.custom_field_breakdown')
            ->with('termcustomfieldbreakdown', $customfieldbreakdown);

    }

    public function breakdown_update(Request $request)
    {
        //dd($request->term_custom_field_id);
        $d = $this->customfieldbreakdown::find($request->breakdown_id);
        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'content_title' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'content_type' => $request->get('content_type'),
                'content_title' => $request->get('content_title'),
                'content_sub_title' => $request->get('content_sub_title'),
                'content_image' => $request->get('content_image'),
                'font_awesome' => $request->get('font_awesome'),
                'content_details' => $request->get('content_details'),
                'content_short_details' => $request->get('content_short_details'),
                'content_zone' => $request->get('zone')
            ];

            //dd($attributes);
            try {
                $done = $this->customfieldbreakdown::where('id', $d->id)->update($attributes);
                //dd($done);
                $r = url("/") . "/admin/common/term/custom_field_breakdown_edit/" . $request->content_term_id . "?zone=" . request()->get('zone') . "&custom_field_id=" . $request->term_custom_field_id . "&custom_field_breakdown_id=" . $d->id;
                return redirect($r)->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function breakdown_destroy($id)
    {
        $mm = $this->customfieldbreakdown->find($id);
        $mm->delete();

        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function breakdown_sorting(Request $request)
    {
        $id = $request->get('id');

        if (!empty($id)) {
            $items = $request->post('item');
            $updatable_array = [];
            foreach ($items as $key => $item) {
                $this->customfieldbreakdown::where('id', $item)->where('term_custom_field_id', $id)->update(['sorting_order' => $key]);
            }
            try {
                return response()->json(['status' => 1, 'message' => 'Successfully sorted']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }

    }

    public function postcode_rate(Request $request)
    {
        return $this->edit($request, $request->id);
    }

    public function postcode_rate_store_update(Request $request)
    {
        if (!empty($request->postcode_id)) {
            foreach ($request->postcode_id as $pc) {
                $check = $this->Model('PostcodeRate')::where('zone_id', $request->zone_id)
                    ->where('service_id', $request->service_id)
                    ->where('postcode_id', $pc)
                    ->first();
                $attr = [
                    'zone_id' => $request->zone_id,
                    'postcode_id' => $pc,
                    'postcode' => $this->Model('Postcode')::getColumn($pc, 'postcode'),
                    'service_id' => $request->service_id,
                    'equation_type' => $request->equation_type,
                    'rate' => $request->rate,
                ];
                //dump($attr);
                if ($check) {
                    //dd('ok');
                    $this->Model('PostcodeRate')::where('id', $check->id)->update($attr);
                } else {
                    //dump($attr);
                    $this->Model('PostcodeRate')::create($attr);
                }
            }
        }
        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully updated']);
    }

    public function postcode_rate_delete($id)
    {
        $data = $this->Model('PostcodeRate')::find($id);
        $data->delete();
        return redirect()->back()->with(['status' => 0, 'message' => 'Successfully deleted']);
    }


    public function import_postcode(Request $request)
    {
        Excel::import(new PostCodeImport($request), request()->file('file'));

        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully imported']);
    }


    public function zone_other_setting(Request $request){
        return $this->edit($request, $request->id);
    }

    public function zone_other_setting_store(Request $request){
//        dd($request->all());
        foreach($request->setting as $key => $value){
            $service_id = $request->service_id;
            $zone_id = $request->zone_id;
            $check = TermZoneOtherSetting::where('service_id', $service_id)->where('zone_id', $zone_id)->where('setting_name', $key)->first();
            if($check){
                $check->update(['setting_value' =>$value]);
            }else {
                $attr = [
                    'service_id' =>$service_id,
                    'zone_id' =>$zone_id,
                    'setting_name' =>$key,
                    'setting_value' =>$value,
                ];
                TermZoneOtherSetting::create($attr);
            }
        }

        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully updated']);
    }

}
