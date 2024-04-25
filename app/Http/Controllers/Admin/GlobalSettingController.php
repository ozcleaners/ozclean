<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalSetting;
use Illuminate\Http\Request;
use Validator;

class GlobalSettingController extends Controller
{
    private $global_setting;

    public function __construct(GlobalSetting $global_setting)
    {
        $this->global_setting = $global_setting;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $global_settings = $this->global_setting::orderBy('name', 'ASC')->get();
        $categories = $this->global_setting::get()->toArray();

        //dd($categories);
        return view('admin.common.settings.global_settings')
            ->with('global_settings', $global_settings)
            ->with('cats', $categories);
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        if (isset($id)) {
            $global_setting = $this->global_setting::where('id', $id)->first();
            $global_settings = $this->global_setting::orderBy('name', 'ASC')->get();
            $categories = $this->global_setting::get()->toArray();
            return view('admin.common.settings.global_settings')
                ->with('global_setting', $global_setting)
                ->with('global_settings', $global_settings)
                ->with('cats', $categories);
        }
    }

    /**
     * @param \App\Http\Controllers\Admin\Request $request
     * @param $id
     * @return $this|RedirectResponse
     */
    public function update(Request $request)
    {
        //dd($request);
        $d = $this->global_setting::find($request->global_setting_id);
        //dd($d);
        //dd($request);
        // store
        $attributes = [
            'name' => $request->get('name'),
            'slogan' => $request->get('slogan'),
            'eshtablished' => $request->get('eshtablished'),
            'license_code' => $request->get('license_code'),
            'logo' => $request->get('logo'),
            'header_photo' => $request->get('header_photo'),
            'phone' => $request->get('phone'),
            'order_phone' => $request->get('order_phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'google_map' => $request->get('google_map'),
            'website' => $request->get('website'),
            'analytics' => $request->get('analytics'),
            'chat_box' => $request->get('chat_box'),
            'meta_title' => $request->get('meta_title'),
            'meta_description' => $request->get('meta_description'),
            'meta_keywords' => $request->get('meta_keywords'),
            'working_hours' => $request->get('working_hours'),
            'admin_name' => $request->get('admin_name'),
            'admin_phone' => $request->get('admin_phone'),
            'admin_email' => $request->get('admin_email'),
            'admin_photo' => $request->get('admin_photo'),
            'facebook_page_id' => $request->get('facebook_page_id'),
            'favicon' => $request->get('favicon'),
            'timezone' => $request->get('timezone')
        ];

        //dd($attributes);

        try {
            $post = $this->global_setting::where('id', $d->id)->update($attributes);
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('global_settings')->withErrors($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return $this
     * @internal param Request $request
     */
    public function store(Request $request)
    {
        //dd($request);
        $attributes = [
            'name' => $request->get('name'),
            'slogan' => $request->get('slogan'),
            'eshtablished' => $request->get('eshtablished'),
            'license_code' => $request->get('license_code'),
            'logo' => $request->get('logo'),
            'header_photo' => $request->get('header_photo'),
            'phone' => $request->get('phone'),
            'order_phone' => $request->get('order_phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'google_map' => $request->get('google_map'),
            'website' => $request->get('website'),
            'analytics' => $request->get('analytics'),
            'chat_box' => $request->get('chat_box'),
            'meta_title' => $request->get('meta_title'),
            'meta_description' => $request->get('meta_description'),
            'meta_keywords' => $request->get('meta_keywords'),
            'working_hours' => $request->get('working_hours'),
            'admin_name' => $request->get('admin_name'),
            'admin_phone' => $request->get('admin_phone'),
            'admin_email' => $request->get('admin_email'),
            'admin_photo' => $request->get('admin_photo'),
            'facebook_page_id' => $request->get('facebook_page_id'),
            'favicon' => $request->get('favicon'),
            'timezone' => $request->get('timezone')
        ];
        //dd($attributes);
        try {
            $done = $this->global_setting->create($attributes);
            //dd($done);
            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            //dd($ex);
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        try {
            $this->global_setting->delete($id);
            return redirect('global_settings')->with('success', 'Successfully deleted');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('global_settings')->withErrors($ex->getMessage());
        }
    }
}
