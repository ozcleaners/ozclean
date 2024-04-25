<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoInformation;
use Illuminate\Http\Request;
use Validator;

class SeoInformationController extends Controller
{
    /**
     * @var SeoInformation
     */
    private $seoInformation;

    /**
     * @param SeoInformation $seoInformation
     */
    public function __construct(SeoInformation $seoInformation)
    {
        $this->seoInformation = $seoInformation;
    }

    public function seo_information()
    {
        return view('admin.common.terms.term_rich_content');
    }

    public function custom_field_seo_store(Request $request)
    {
        //dd($request);

        $validator = Validator::make(
            $request->all(),
            [
                'content_id' => 'required',
                'content_type' => 'required',
                'meta_title' => 'required'
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
                'content_id' => $request->get('content_id'),
                'content_type' => $request->get('content_type'),
                'meta_title' => $request->get('meta_title'),
                'meta_description' => $request->get('meta_description'),
                'meta_keywords' => $request->get('meta_keywords'),
                'canonical_tags' => $request->get('canonical_tags'),
                'meta_author' => $request->get('meta_author'),
                'meta_zone' => $request->get('meta_zone') ?? NULL
            ];

            //dd($attributes);
            try {
                $done = $this->seoInformation->create($attributes);
                //dd($done);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function custom_field_seo_update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'content_id' => 'required',
                'content_type' => 'required',
                'meta_title' => 'required'
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
                'content_id' => $request->get('content_id'),
                'content_type' => $request->get('content_type'),
                'meta_title' => $request->get('meta_title'),
                'meta_description' => $request->get('meta_description'),
                'meta_keywords' => $request->get('meta_keywords'),
                'canonical_tags' => $request->get('canonical_tags'),
                'meta_author' => $request->get('meta_author'),
                'meta_zone' => $request->get('meta_zone') ?? NULL
            ];

            //dd($attributes);
            try {
                $done = $this->seoInformation->where('id', $request->id)->update($attributes);
                //dd($done);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }
}
