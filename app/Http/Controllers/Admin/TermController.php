<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Harimayco\Menu\Facades\Menu;
use Illuminate\Http\Request;
use Validator;
use App\Models\SeoInformation;

class TermController extends Controller
{
    private $term;
    private $seoInformation;

    public function __construct(Term $term, SeoInformation $seoInformation)
    {
        $this->term = $term;
        $this->seoInformation = $seoInformation;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $terms = $this->term::orderBy('name', 'ASC')->get();
        $categories = $this->term::get()->toArray();

        //dd($categories);
        return view('admin.common.terms.terms')
            ->with('terms', $terms)
            ->with('cats', $categories);
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        if (isset($id)) {
            $term = $this->term::where('id', $id)->first();
            $terms = $this->term::orderBy('name', 'ASC')->get();
            $categories = $this->term::get()->toArray();
            return view('admin.common.terms.terms')
                ->with('term', $term)
                ->with('terms', $terms)
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
        //dd($request->all());
        $d = $this->term::find($request->term_id);
        //dd($d);
        //dd($request);
        // store
        //$table->enum('calculator_template', ['regular', 'breakdown'])->nullable();
        $attributes = [
//            'which_editor' => $request->get('which_editor'),
            'calculator_template' => $request->get('calculator_template'),
            'name' => $request->get('term_name'),
            'term_subtitle' => $request->get('term_subtitle'),
            'seo_url' => $request->get('seo_url'),
            'cat_theme' => $request->get('cat_theme'),
            'type' => $request->get('term_type'),
            'position' => $request->get('term_position'),
            'cssid' => $request->get('term_css_id'),
            'cssclass' => $request->get('term_css_class'),
            'description' => $request->get('term_content'),
            'grapes_description' => $request->get('grapes_description'),
            'grapes_css' => $request->get('grapes_css'),
            'term_short_description' => $request->get('term_short_description'),
            'parent' => $request->get('term_parent'),
            'level_no' => $request->get('level_no'),
            'connected_with' => $request->get('connected_with'),
            'page_image' => $request->get('page_image'),
            'thumb_image' => $request->get('thumb_image'),
            'home_image' => $request->get('home_image'),
            'term_menu_icon' => $request->get('term_menu_icon'),
            'term_menu_arrow' => $request->get('term_menu_arrow'),
            'checklist' => $request->get('checklist'),
            'alternative_name' => $request->get('alternative_name'),
            'with_sub_menu' => $request->get('with_sub_menu'),
            'sub_menu_width' => $request->get('sub_menu_width'),
            'banner1' => $request->get('banner1'),
            'banner2' => $request->get('banner2'),
            'onpage_banner' => $request->get('onpage_banner'),
            'column_count' => $request->get('column_count'),
            'is_active' => 1
        ];
        /**
         * Seo Update
         */

        $term_seo_informations = [
            'content_id' => $request->content_id ?? NULL,
            'content_type' => $request->content_type,
            'meta_zone' => $request->meta_zone,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'canonical_tags' => $request->canonical_tags,
            'meta_author' => $request->meta_author,
        ];
        if ($request->seo_information_row_id) {
            $done = $this->seoInformation->where('id', $request->seo_information_row_id)->update($term_seo_informations);
        } else {
            $this->seoInformation->create($term_seo_informations);
        }
        //dd($attributes);

        try {
            $post = $this->term::where('id', $d->id)->update($attributes);
            return redirect()->back()->with(['status' => 1, 'message' => 'Term has been updated successfully.']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('terms')->withErrors($ex->getMessage());
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
        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'term_name' => 'required',
                'seo_url' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('terms')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'calculator_template' => $request->get('calculator_template'),
                'name' => $request->get('term_name'),
                'term_subtitle' => $request->get('term_subtitle'),
                'seo_url' => $request->get('seo_url'),
                'cat_theme' => $request->get('cat_theme'),
                'type' => $request->get('term_type'),
                'position' => $request->get('term_position'),
                'cssid' => $request->get('term_css_id'),
                'cssclass' => $request->get('term_css_class'),
                'description' => $request->get('term_content'),
                'grapes_description' => $request->get('grapes_description'),
                'grapes_css' => $request->get('grapes_css'),
                'term_short_description' => $request->get('term_short_description'),
                'parent' => $request->get('term_parent'),
                'level_no' => $request->get('level_no'),
                'connected_with' => $request->get('connected_with'),
                'page_image' => $request->get('page_image'),
                'thumb_image' => $request->get('thumb_image'),
                'home_image' => $request->get('home_image'),
                'term_menu_icon' => $request->get('term_menu_icon'),
                'term_menu_arrow' => $request->get('term_menu_arrow'),
                'checklist' => $request->get('checklist'),
                'alternative_name' => $request->get('alternative_name'),
                'with_sub_menu' => $request->get('with_sub_menu'),
                'sub_menu_width' => $request->get('sub_menu_width'),
                'banner1' => $request->get('banner1'),
                'banner2' => $request->get('banner2'),
                'onpage_banner' => $request->get('onpage_banner'),
                'column_count' => $request->get('column_count'),
                'is_active' => 1
            ];
            $term = $this->term->create($attributes);

            /** @var  $term_seo_informations */
            $term_seo_informations = [
                'content_id' => $term->id ?? NULL,
                'content_type' => $request->content_type,
                'meta_zone' => $request->meta_zone,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'canonical_tags' => $request->canonical_tags,
                'meta_author' => $request->meta_author,
            ];
            $this->seoInformation->create($term_seo_informations);


            try {
                return redirect()->back()->with('success', 'Successfully save changed');
            } catch (\Illuminate\Database\QueryException $ex) {
                //dd($ex->errorInfo[1]);
                if ($ex->errorInfo[1] == 1062) {
                    $option = [
                        'seo_url' => $request->get('seo_url') . '_' . rand()
                    ];
                    //dd($option);
                    $attribute = array_merge($attributes, $option);

                    $done = $this->term->create($attribute);

                    return redirect()->back()->with('success', 'Successfully save changed');
                } else {
                    return redirect()->back()->withErrors($ex->getMessage());
                }
            }
        }
    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $data = Term::find($id);
        $data->delete();
        try {
            return redirect()->route('common_term_index')->with(['status' => 1, 'message' => 'Successfully deleted']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->route('common_term_index')->withErrors($ex->getMessage());
        }
    }

    // Custom Methods

    public function check_if_cat_url_exists(Request $request)
    {
        $seo_url = $request->get('seo_url');
        $term = $this->term->getByAny('seo_url', $seo_url);
        if ($term->first()) {
            $url = $term->first()->seo_url;
            $nu = $url . '-' . date('ms');
            $m = $nu;
        } else {
            $m = $seo_url;
        }
        return response()->json(['url' => $m]);
    }

    public function get_categories_on_search(Request $request)
    {
        $terms = \App\Term::where('name', 'like', '%' . $request->get('search_param') . '%')->orderBy('name', 'asc')->get();
        //dd($terms);
        $main_pid = $request->get('main_pid');

        $html = null;
        foreach ($terms as $term) {
            $html .= '<option id="dblclick_cat"
            value="' . $term->id . '"
            data-mainpid="' . (!empty($main_pid) ? $main_pid : null) . '"
            data-userid="' . (!empty(\Auth::user()->id) ? \Auth::user()->id : null) . '"
            data-title="' . $term->name . '"
            data-attgroup="' . $term->connected_with . '">';
            $html .= $term->name;
            $html .= '</option>';

            $sub_terms = \App\Term::where('parent', $term->id)->orderBy('name', 'asc')->get();
            foreach ($sub_terms as $sub_term) {
                $html .= '<option id="dblclick_cat"
                value="' . $sub_term->id . '"
                data-mainpid="' . (!empty($main_pid) ? $main_pid : null) . '"
                data-userid="' . (!empty(\Auth::user()->id) ? \Auth::user()->id : null) . '"
                data-title="' . $sub_term->name . '"
                data-attgroup="' . $sub_term->connected_with . '">';
                $html .= '&nbsp;&nbsp;&nbsp;' . $sub_term->name;
                $html .= '</option>';

                $sub_termss = \App\Term::where('parent', $sub_term->id)->orderBy('name', 'asc')->get();
                foreach ($sub_termss as $sub_terms) {
                    $html .= '<option id="dblclick_cat"
                    value="' . $sub_terms->id . '"
                    data-mainpid="' . (!empty($main_pid) ? $main_pid : null) . '"
                    data-userid="' . (!empty(\Auth::user()->id) ? \Auth::user()->id : null) . '"
                    data-title="' . $sub_terms->name . '"
                    data-attgroup="' . $sub_terms->connected_with . '">';
                    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $sub_terms->name;
                    $html .= '</option>';
                }
            }
        }

        return response()->json(['html' => $html]);
    }


    /**
     * WordPress Like Menus Manager
     * @return $this
     */
    public function menus()
    {
        $menuList = Menu::get(1);
        return view('admin.common.terms.menus')->with('menus', $menuList);
    }


    public function grapes_update(Request $request)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $request['id'];
        $css = $data['gjs-css'];
        //dd($css);
        $html = $data['gjs-html'];
        // $assets = $data['gjs-assets'];
        // $assets=json_encode($assets);
        // $components = $data['gjs-components'];
        // $components=json_encode($components);
        // $css = $data['gjs-css'];
        // $css = json_encode($css);
        // $html = $data['gjs-html'];
        // $html= json_encode($html);
        // $styles = $data['gjs-styles'];
        // $styles = json_encode($styles);

        // process the login

        $attributes = [
            'grapes_description' => $html,
            'grapes_css' => $css
        ];
        try {
            $term = $this->term::where('id', $id)->update($attributes);
            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function grapes_load_now(Request $request)
    {
        $id = $request['id'];

        if (isset($id)) {
            $term = $this->term::where('id', $id)->first();
            $ghtml = $term->grapes_description;
            $gcss = $term->grapes_css;

            $response['gjs-html'] = $ghtml;
            $response['gjs-css'] = $gcss;

            $json_response = $response;
            return $json_response;
        }
    }


}
