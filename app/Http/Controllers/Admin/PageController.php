<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Validator;
use Carbon\Carbon;

class PageController extends Controller
{
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $pages = $this->page::orderBy('id', 'ASC')->paginate(30);

        //dd($categories);
        return view('admin.common.pages.pages')
            ->with('pages', $pages);
    }

    public function create()
    {
        $pages = $this->page::orderBy('id', 'ASC')->paginate(30);

        return view('admin.common.pages.form')
            ->with('pages', $pages);
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
                'images' => $request->get('images'),
                'youtube' => $request->get('youtube'),
                'short_description' => $request->get('short_description'),
                'is_sticky' => $request->get('is_sticky'),
                'lang' => $request->get('lang'),
                'template' => $request->get('template'),
                'is_active' => $request->get('is_active'),
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'seo_keywords' => $request->seo_keywords,
                'h1tag' => $request->h1tag,
                'h2tag' => $request->h2tag,
                'created_at' => isset($request->created_at) ? Carbon::parse($request->created_at) : Carbon::now()
            ];
            //dd($attributes);

            try {
                $this->page::create($attributes);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully Added']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }

    public function edit($id)
    {
        if (isset($id)) {
            $page = $this->page::where('id', $id)->first();

            return view('admin.common.pages.form')
                ->with('page', $page);
        }
    }

    public function update(Request $request)
    {
//        dd($request);
        $d = $this->page::where('id', $request->page_id)->first();

        // read more on validation at
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'seo_url' => 'required'
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('pages')
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
                'images' => $request->get('images'),
                'youtube' => $request->get('youtube'),
                'short_description' => $request->get('short_description'),
                'is_sticky' => $request->get('is_sticky'),
                'lang' => $request->get('lang'),
                'template' => $request->get('template'),
                'is_active' => $request->get('is_active'),
                'seo_title' => $request->seo_title,
                'seo_description' => $request->seo_description,
                'seo_keywords' => $request->seo_keywords,
                'h1tag' => $request->h1tag,
                'h2tag' => $request->h2tag,
            ];

            if ($request->created_at) {
                $attributes['created_at'] = Carbon::parse($request->created_at);
            }

            //dd($attributes);
            try {
                $page = $this->page::where('id', $d->id)->update($attributes);
                return redirect()->back()->with(['status' => 1, 'message' => 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }
    }


    public function destroy($id){
        $data = $this->page::find($id);
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
            $page = $this->page::where('id', $id)->update($attributes);
            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }

    }

    public function grapes_load_now(Request $request)
    {
        $id = $request['id'];

        if (isset($id)) {
            $page = $this->page::where('id', $id)->first();
            $ghtml = $page->grapes_description;
            $gcss = $page->grapes_css;

            $response['gjs-html'] = $ghtml;
            $response['gjs-css'] = $gcss;

            $json_response = $response;
            return $json_response;
        }
    }

    public function apiGet(Request $request)
    {
        $page = $this->page::query()->orderBy('id', 'desc');

        $field = [
            'button' => 'App\Helpers\ButtonSet::delete("common_page_destroy", $data->id).
                        App\Helpers\ButtonSet::edit("common_page_edit", $data->id)',
            'title' => '$data->title',
            'sub_title' => '$data->sub_title',
            'seo_url' => '"/".$data->seo_url',
            'author' => '$data->author',
            'description' => '$data->description'
        ];

        return $this->Datatable::generate($request, $page, $field);
    }


    // 'id`, `which_editor`, `user_id`, `title`, `sub_title`, `seo_url`, `author`, `description`, `grapes_description`, `grapes_css`, `images`, `short_description`, `youtube`, `h1tag`, `h2tag`, `seo_title`, `seo_description`, `seo_keywords`, `is_sticky`, `lang`, `is_active`, `created_at`, `updated_at`
}
