<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AlbumController extends Controller
{
    private $album;

    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $albums = $this->album::paginate('20');

        if (!empty($request->id)) {
            $album = $this->album::find($request->id);
        } else {
            $album = '';
        }

        return view('admin.common.gallery-album.album.albums')->with(['albums' => $albums, 'album' => $album]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $attr = [
            'name' => $request->album_name,
            'description' => $request->album_content,
            'albums_pcat_id' => $request->albums_pcat_id,
            'cssclass' => $request->album_css_class,
            'cssid' => $request->album_id,
            'position' => $request->album_position,
            'is_active' => $request->is_active
        ];

        $this->album::create($attr);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $d = $this->album::find($id);

        // read more on validation at
        $validator = Validator::make($request->all(),
            [
                'album_name' => 'required',
                'album_content' => 'required',
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('sliders')
                ->withErrors($validator)
                ->withInput();
        } else {

            $attr = [
                'name' => $request->album_name,
                'description' => $request->album_content,
                'albums_pcat_id' => $request->albums_pcat_id,
                'cssclass' => $request->album_css_class,
                'cssid' => $request->album_id,
                'position' => $request->album_position,
                'is_active' => $request->is_active
            ];
            $this->album::where('id', $id)->update($attr);

            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Album $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Album::find($id);
        $data->delete();
        return redirect()->back()->with(['status' => 0, 'message' => 'Successfully deleted']);
    }
}