<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    private $request;
    private $gallery;

    /**
     * GalleryController constructor.
     * @param Request $request
     * @param GalleryInterface $gallery
     */
    public function __construct(Request $request, Gallery $gallery)
    {
        $this->request = $request;
        $this->gallery = $gallery;
    }

    public function galleries()
    {
        $gallery = $this->gallery::where('gallery_for', 'General')->paginate('30');
        $image = false;

        if ($this->request->id) {
            $image = $this->gallery::find($this->request->id);
        }
        return response()->view('admin.common.gallery-album.gallery.index', compact('gallery', 'image'));
    }

    public function service_galleries()
    {
        $gallery = $this->gallery::where('gallery_for', 'Service')->orderBy('id', 'desc')->paginate('30');
        $image = false;
        if ($this->request->id) {
            $image = $this->gallery::find($this->request->id);
        }
        return response()->view('admin.common.gallery-album.gallery.service_gallery_index', compact('gallery', 'image'));
    }


    public function galleryStore(request $request)
    {

        $existedGallery = \App\Models\Gallery::orderBy('serial', 'DESC')->first();
        $serial = ($existedGallery->serial ?? 0) + 1;

        $attr = [
            'gallery_for' => $request->gallery_for,
            'media_id' => $request->media_id,
            'category_id' => $request->album_id,
            'parent_category_id' => $request->parent_category_id,
            'serial' => $serial,
            'caption' => $request->caption,
            'active' => $request->active
        ];
//        dd($attr);
        $this->gallery->create($attr);

        return redirect()->back();
    }


    public function galleryUpdate($id, Request $request)
    {
//        dd($id);
        $gallery = $this->gallery::find($id);
        $gallery->gallery_for = $request->gallery_for;
        $gallery->media_id = $request->media_id;
        $gallery->category_id = $request->album_id;
        $gallery->parent_category_id = $request->parent_category_id;
        $gallery->caption = $request->caption;
        $gallery->active = $request->active;
        $gallery->save();
//        dd($request->all());
        return redirect()->back();
    }


    public function galleryDelete($id)
    {
        $gallery = $this->gallery::find($id);
        $gallery->delete();
        return redirect()->back();
    }


    public function gallerySerialUpdate(Request $request)
    {

        $datas = $request->get('item');

        foreach ($datas as $data) {
            $gallery = $this->gallery::find($data['id']);
            $gallery->serial = $data['serial'];
            $gallery->save();
        }
    }
}
