<?php

namespace App\Http\Controllers\Admin;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceGalleryController extends Controller
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
        $gallery = $this->gallery::paginate('20');
        $image = false;

        if ($this->request->id) {
            $image = $this->gallery::find($this->request->id);
        }

        return response()->view('admin.common.gallery-album.gallery.index',compact('gallery','image'));
    }


    public function galleryStore()
    {

        $existedGallery = \App\Models\Gallery::orderBy('serial','DESC')->first();
        $serial = ($existedGallery->serial??0)+1;

        $attr  = [
            'media_id' => $this->request->imageId,
            'category_id' => $this->request->album_id,
            'serial' => $serial,
            'caption' => $this->request->caption,
            'active' => $this->request->active
        ];
        $this->gallery->create($attr);

        return redirect()->back();
    }


    public function galleryUpdate($id)
    {
        $gallery = $this->gallery::find($id);
        $gallery->media_id = $this->request->imageId;
        $gallery->category_id = $this->request->album_id;
        $gallery->caption = $this->request->caption;
        $gallery->active = $this->request->active;
        $gallery->save();

        return redirect()->back();
    }


    public function galleryDelete($id)
    {
        $gallery = $this->gallery::find($id);
        $gallery->delete();
        return redirect()->back();
    }


    public function gallerySerialUpdate(Request $request) {

        $datas = $request->get('item');

        foreach($datas as $data) {
            $gallery = $this->gallery::find($data['id']);
            $gallery->serial = $data['serial'];
            $gallery->save();
        }
    }
}
