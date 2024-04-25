<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\SeoInformation;
use App\Models\Term;
use App\Models\TermCustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class ServiceController extends Controller
{
    public function __construct()
    {
    }

    public function service_parent(Request $request)
    {
//        dump($request->zone);
//        dump($request->parent_term);
        
      
      
      	if($request->parent_term == 'residential-property') {
          $parent_term = 'residential-cleaning';          

          return Redirect::to('https://ozcleaners.com.au/service/' . $request->zone . '/' . $parent_term);          
          
        } else if($request->parent_term == 'commercial-property') {
          $parent_term = 'commercial-cleaning';
          
          
          return Redirect::to('https://ozcleaners.com.au/service/' . $request->zone . '/' . $parent_term);
          
        } else {
          $parent_term = Term::where('seo_url', $request->parent_term)->first();;
        }
      
      
        if($parent_term == null){
            return abort(404);
        }
//        $term_seo_information = SeoInformation::where('content_id', $parent_term->id)->where('content_type', 'Term')->first();
        $term_seo_information = SeoInformation::where('content_id', $parent_term->id ?? NULL)->where('meta_zone', $request->zone)->where('content_type', 'Term')->first();
        $parent_term_and_zone_wise_term_title = TermCustomField::where('content_term_parent_id', $parent_term->id)
            ->where('content_zone', $request->zone)
            ->where('content_type', 'Term Title')
            ->get();

        return view('frontend.zone_wise_service_parent')->with([
            'zone' => $request->zone,
            'parent_seo_url' => $request->parent_term,
            'term_title' => $request->term_title,
            'term' => $parent_term,
            'seo_information' => $term_seo_information,
            'parent_term_and_zone_wise_term_title' => $parent_term_and_zone_wise_term_title,
        ]);
    }

    public function service_single(Request $request)
    {
        // dump($request->zone); // adelaide
        // dd($request->parent_term); // residential-property
        // dump($request->term_title); // solar-panel-cleaning
      
      	if($request->parent_term == 'residential-property') {
          $parent_term = 'residential-cleaning';          

          return Redirect::to('https://ozcleaners.com.au/service/' . $request->zone . '/' . $parent_term . '/' . $request->term_title);          
          
        } else if($request->parent_term == 'commercial-property') {
          $parent_term = 'commercial-cleaning';
          
          
          return Redirect::to('https://ozcleaners.com.au/service/' . $request->zone . '/' . $parent_term . '/' . $request->term_title);
          
        } else {
          $parent_term = $request->parent_term;
        }
        
      
        $content_term_parent_id = Term::where('seo_url', $request->parent_term)->first()->id;
        $content_zone_info = AttributeValue::where('slug', $request->zone)->where('unique_name', 'Zone')->first();
        $content_zone = $content_zone_info->value ?? null;

        //$term_custom_field_id = TermCustomField::where('content_seo_url', $request->term_title)->first()->content_term_id ?? NULL;
        $term_custom_field = TermCustomField::where('content_seo_url', $request->term_title)
                            ->where('content_term_parent_id', $content_term_parent_id)
                            ->where('content_zone', $content_zone)
                            ->where('content_type', 'Term Title')
                            ->where('content_for', 'Term')
                            ->first();
        $zone_id = $content_zone_info->id ?? null;
//        dd($term_custom_field->content_term_id);
        $checkActive = $this->Model('TermZoneOtherSetting')::getValue($term_custom_field->content_term_id, $zone_id, 'zone_content_is_active') ?? null;


        if($term_custom_field == null){
            return redirect()->route('frontend_zone_wise_service_parent', [$request->zone, $request->parent_term]);
        }
        $term = Term::where('id', $term_custom_field->content_term_id ?? null)->first();
        $term_parent_data = Term::where('seo_url', $request->parent_term)->first();
        $term_seo_information = SeoInformation::where('content_id', $term->id ?? NULL)->where('meta_zone', $request->zone)->where('content_type', 'Term')->first();
        if($checkActive != 'No') {
            return view('frontend.zone_wise_service_single')->with([
                'zone' => $request->zone,
                'parent_seo_url' => $request->parent_term,
                'term_title' => $request->term_title,
                'term' => $term,
                'term_custom_field' => $term_custom_field,
                'term_parent_data' => $term_parent_data,
                'seo_information' => $term_seo_information
            ]);
        }else {
            return abort(404);
        }
    }
}
