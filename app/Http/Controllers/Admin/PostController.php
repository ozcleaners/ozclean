<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Datatable;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Term;
use Illuminate\Http\Request;
use Validator;
use App\Models\SeoInformation;
use Carbon\Carbon;

class PostController extends Controller
{
    private $post;
    private $term;
    private $seoInformation;

    public function __construct(Post $post, Term $term, SeoInformation $seoInformation)
    {
        $this->post = $post;
        $this->term = $term;
        $this->seoInformation = $seoInformation;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $posts = $this->post::orderBy('id', 'ASC')->paginate(30);
        $cats = $this->term::get()->toArray();

        //dd($categories);
        return view('admin.common.posts.index')
            ->with('posts', $posts)
            ->with('cats', $cats);
    }

    public function create()
    {
//        $posts = $this->post::orderBy('id', 'ASC')->paginate(30);
        $post = null;
        $cats = $this->term::get()->toArray();

        return view('admin.common.posts.form')
            ->with('post', $post)
            ->with('cats', $cats);
    }

    public function store(Request $request)
    {
        //dd($request);

        // validate
        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'seo_url' => 'required',
                //'description' => 'required',
                'categories' => 'required',
                'lang' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'which_editor' => $request->get('which_editor'),
                'user_id' => $request->get('user_id'),
                'title' => $request->get('title'),
                'sub_title' => $request->get('sub_title'),
                'seo_url' => $request->get('seo_url'),
                'author' => $request->get('author'),
                'description' => $request->get('description'),
                'grapes_description' => $request->get('grapes_description'),
                'grapes_css' => $request->get('grapes_css'),
                'categories' => implode(',', $request->get('categories')),
                'images' => $request->get('images'),
                'brand' => $request->get('brand'),
                'tags' => $request->get('tags'),
                'youtube' => $request->get('youtube'),
                'is_auto_post' => $request->get('is_auto_post'),
                'short_description' => $request->get('short_description'),
                'phone' => $request->get('phone'),
                'district' => NULL, //get_dis_or_div_by_thana($request->get('thana'))->district,
                'division' => NULL, //get_dis_or_div_by_thana($request->get('thana'))->division,
                'thana' => NULL, //$request->get('thana'),
                'shop_type' => $request->get('shop_type'),
                'opening_hours' => $request->get('opening_hours'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'phone_numbers' => $request->get('phone_numbers'),
                'address' => $request->get('address'),
                'is_upcoming' => $request->get('is_upcoming'),
                'is_sticky' => $request->get('is_sticky'),
                'lang' => $request->get('lang'),
                'is_active' => $request->get('is_active'),
                'position' => $request->get('position'),
                'font_awesome_icon' => $request->get('font_awesome_icon'),
                'created_at' => isset($request->created_at) ? Carbon::parse($request->created_at) : Carbon::now()
            ];

            //dd($attributes);
            $post = $this->post::create($attributes);

            /** @var  $term_seo_informations */
            $term_seo_informations = [
                'content_id' => $post->id ?? NULL,
                'content_type' => $request->content_type,
                'meta_zone' => $request->meta_zone,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'canonical_tags' => $request->canonical_tags,
                'meta_author' => $request->meta_author,
            ];
            //dd($term_seo_informations);
            $this->seoInformation->create($term_seo_informations);

            try {
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Added']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors(['status' => 0, 'message' => $ex->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        if (isset($id)) {
            $post = $this->post::where('id', $id)->first();
            $cats = $this->term::get()->toArray();

            return view('admin.common.posts.form')
                ->with('post', $post)
                ->with('cats', $cats);
        }
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $d = $this->post::where('id', $request->post_id)->first();

        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'seo_url' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('posts')
                ->withErrors($validator)
                ->withInput();
        } else {
            $attributes = [
                'which_editor' => $request->get('which_editor'),
                'user_id' => $request->get('user_id'),
                'title' => $request->get('title'),
                'sub_title' => $request->get('sub_title'),
                'seo_url' => $request->get('seo_url'),
                'author' => $request->get('author'),
                'description' => $request->get('description'),
                'grapes_description' => $request->get('grapes_description'),
                'grapes_css' => $request->get('grapes_css'),
                'categories' => implode(',', $request->get('categories')),
                'images' => $request->get('images'),
                'brand' => $request->get('brand'),
                'tags' => $request->get('tags'),
                'youtube' => $request->get('youtube'),
                'is_auto_post' => $request->get('is_auto_post'),
                'short_description' => $request->get('short_description'),
                'phone' => $request->get('phone'),
                'district' => NULL, //get_dis_or_div_by_thana($request->get('thana'))->district,
                'division' => NULL, //get_dis_or_div_by_thana($request->get('thana'))->division,
                'thana' => NULL, //$request->get('thana'),
                'shop_type' => $request->get('shop_type'),
                'opening_hours' => $request->get('opening_hours'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'phone_numbers' => $request->get('phone_numbers'),
                'address' => $request->get('address'),
                'lang' => $request->get('lang'),
                'is_upcoming' => $request->get('is_upcoming'),
                'is_auto_post' => $request->get('is_auto_post'),
                'is_sticky' => $request->get('is_sticky'),
                'position' => $request->get('position'),
                'font_awesome_icon' => $request->get('font_awesome_icon'),
                'is_active' => $request->get('is_active'),
            ];

            if ($request->created_at) {
                $attributes['created_at'] = Carbon::parse($request->created_at);
            }


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
                $post = $this->post::where('id', $d->id)->update($attributes);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }


    public function destroy($id){
        $data = $this->post::find($id);
        $data->delete();
        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
    }

    public function grapes_update(Request $request)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $request['id'];
        $css = $data['gjs-css'];
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
            $post = $this->post::where('id', $id)->update($attributes);
            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }

    }

    public function grapes_load_now(Request $request)
    {
        $id = $request['id'];

        if (isset($id)) {
            $post = $this->post::where('id', $id)->first();
            $ghtml = $post->grapes_description;
            $gcss = $post->grapes_css;

            $response['gjs-html'] = $ghtml;
            $response['gjs-css'] = $gcss;

            $json_response = $response;
            return $json_response;
        }
    }

    public function apiGet(Request $request)
    {
        $post = $this->post::query()->orderBy('id', 'desc');

        $field = [
            'button' => 'App\Helpers\ButtonSet::delete("common_post_destroy", $data->id).App\Helpers\ButtonSet::edit("common_post_edit", $data->id)',
            'title' => '$data->title',
            'sub_title' => '$data->sub_title',
            'seo_url' => '$data->seo_url',
            'categories' => 'App\Models\Term::getNames($data->categories)',
            'author' => '$data->author',
            'description' => 'App\Helpers\Datatable::textLimit($data->description, 50)'
        ];

        return $this->Datatable::generate($request, $post, $field);
    }
}
