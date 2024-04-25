<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //Single Album Photo
    public function albumPhoto($id)
    {
        $albumPhoto = $this->Query::accessModel('Gallery')::where('category_id', $id)->orderBy('id', 'DESC')->where('active', '1')->get();
        $albumName = $this->Query::accessModel('Album')::where('id', $id)->get();

        return view('frontend.templates.page.single-photo', compact('albumPhoto', 'albumName'));
    }

    //Parent Album Index
    public function parentAlbum($id)
    {
        $albums = $this->Query::accessModel('Album')::where('albums_pcat_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.templates.page.albums', compact('albums'));
    }

    //Gallery Photo Index
    public function albums()
    {
        $albums = $this->Query::accessModel('AlbumsPcat')::orderBy('id', 'DESC')->where('is_active', '1')->get();
        return view('frontend.templates.page.albums', compact('albums'));
    }


    public function serviceGallery(Request $request)
    {
        return redirect()->to('/');
        if (!empty($request->get('album'))) {
            $albums = $this->Query::accessModel('Gallery')::where('gallery_for', 'Service')->groupBy('parent_category_id')->get();
            $sub_albums = $this->Query::accessModel('Gallery')::where('parent_category_id', request()->get('album'))->get();
        } else {
            $albums = $this->Query::accessModel('Gallery')::where('gallery_for', 'Service')->groupBy('parent_category_id')->get();
            $sub_albums = null;
        }
        return view('frontend.templates.page.photo-gallery')->with(['albums' => $albums, 'sub_albums' => $sub_albums]);
        //dd($albums);
    }


    public function parentSeviceGallery(Request $request)
    {
        $parent_term = $request->parent_term;
        $parent_sub_term = $request->parent_sub_term;
        if ($parent_term) {
            $parent_term = $this->Model('Term')::getColumnById($parent_term, 'id');
            $cat_id = $parent_term;
            $photos = $this->Model('Gallery')::where('gallery_for', 'Service')->where('parent_category_id', $cat_id)->get();
        }
        if ($parent_sub_term) {
            $parent_sub_term = $this->Model('Term')::getColumnById($parent_sub_term, 'id');
            $cat_id = $parent_sub_term;
            $photos = $this->Model('Gallery')::where('gallery_for', 'Service')->where('category_id', $cat_id)->get();
        }
        //dd($parent_sub_term);

//        dd($data);
        $albums = $this->Model('Gallery')::where('gallery_for', 'Service')->groupBy('parent_category_id')->get();
        return view('frontend.templates.page.photo-gallery')->with([
            'albums' => $albums,
            'photos' => $photos,
            'parent_term' => $parent_term,
            'parent_sub_term' => $parent_sub_term,
        ]);
    }
}
