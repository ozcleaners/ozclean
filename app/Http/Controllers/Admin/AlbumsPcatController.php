<?php

namespace App\Http\Controllers\Admin;

use App\Models\AlbumsPcat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AlbumsPcatController extends Controller
{
     private $albumPcat;

    public function __construct(AlbumsPcat $albumPcat)
    {
        $this->albumPcat = $albumPcat;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $albumsPcat = $this->albumPcat::paginate('20');

        if (!empty($request->id)) {
            $albumPcat = $this->albumPcat::find($request->id);
        } else {
            $albumPcat = '';
        }
        return view('admin.common.gallery-album.album.albums-pcat')->with(['albumsPcat' => $albumsPcat, 'albumPcat' => $albumPcat]);
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
            'name' => $request->album_pcat_name,
            'cover_photo' => $request->cover_photo,
            'is_active' => $request->is_active
        ];

        $this->albumPcat::create($attr);

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
        $d = $this->albumPcat::find($id);

        // read more on validation at
        $validator = Validator::make($request->all(),
            [
                'album_pcat_name' => 'required',
            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('sliders')
                ->withErrors($validator)
                ->withInput();
        } else {

            $attr = [
                'name' => $request->album_pcat_name,
                'cover_photo' => $request->cover_photo,
                'is_active' => $request->is_active
            ];
            $this->albumPcat::where('id', $id)->update($attr);

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
        $data = $this->albumPcat::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
