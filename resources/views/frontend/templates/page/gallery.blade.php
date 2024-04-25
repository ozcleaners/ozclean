@php
if(request()->get('sub_album')){
    $subAlbumId = request()->get('sub_album');
    $query = $Query::accessModel('Album')::where('albums_pcat_id', $subAlbumId)->orderBy('id', 'DESC')->get();
    $pageName = $Query::accessModel('AlbumsPcat')::where('id', $subAlbumId)->orderBy('id', 'DESC')->first()->name;
} else {
    $subAlbumId = null;
    $query = $Query::accessModel('AlbumsPcat')::orderBy('id', 'DESC')->where('is_active', '1')->get();
    $pageName = '';
}

if(request()->get('album')){
    $album_id = request()->get('album');
    $query = $Query::accessModel('Gallery')::where('category_id', $album_id)->orderBy('id', 'DESC')->where('active', '1')->get();
    $pageName = $Query::accessModel('Album')::where('id', $album_id)->orderBy('id', 'DESC')->first()->name;
} else {
    $album_id = null;
}

@endphp

<section class="container">

    <div id="pagetitle" class="page-title bg-image ">
        <div class="container">
            <div class="page-title-inner">
                <div class="image-overlay"></div>
                <div class="page-title-holder">
                    <h1 class="page-title">
                        {{$page->title}}
                        @isset($pageName)
                        <span style="font-weight: 300;font-family: sans-serif;">|</span>
                        <span style="font-size: 20px;">{{$pageName}}</span>
                        @endisset
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach($query as $album)
                @php
                    $checkParentId = $album->albums_pcat_id;
                    if(empty($checkParentId)){
                        $setRequest = 'sub_album='.$album->id;
                        $image = $album->cover_photo;
                    } else {
                            $setRequest = 'album='.$album->id;
                            $galleryFirstPhoto = $Query::accessModel('Gallery')::where('category_id', $album->id)->orderBy('id', 'DESC')->get()->first();
                            $image = $galleryFirstPhoto['media_id'] ?? NULL;
                    }
                @endphp

                <div class="col-md-4" id="{{$album_id ? 'lightgallery' : ''}}">
                    @if($album_id)
                    <!-- Album Image -->
                        <div class="" data-responsive="{{ $Media::fullSize($album->media_id) }}"
                                        data-src="{{ $Media::fullSize($album->media_id) }}"
                                        data-sub-html="<h4>{{$album->caption}}</h4>">

                            <figure class="img-resposnive" style="cursor: pointer;">
                                <img src="{{$Media::fullSize($album->media_id)}}" />
                            </figure>

                        </div>
                    @else
                        <!-- Album /Sub Album -->
                        <div class="postbox-wrap">
                            <div class="postbox-thumbnail">
                                <a href={{ route('frontend_page' , $page->seo_url) }}?{{$setRequest}}">
                                    <img class="img-responsive" src="{{ $Media::fullSize($image) }}" alt="">
                                </a>
                            </div>
                            <div class="postbox-content">
                                <div class="postbox-content-inner">
                                    <h3 class="postbox-content-heading">
                                        <a href="{{ route('frontend_page' , $page->seo_url) }}?{{$setRequest}}">{{ $album->name }}</a>
                                    </h3>
                                    <div class="postbox-content-readmore">
                                        <a href="{{ route('frontend_page' , $page->seo_url) }}?{{$setRequest}}"> View all <i
                                                class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                @endforeach
            </div>
        </div>
    </div>






</section>




@section('cusjs')
<script>
    $(document).ready(function(){
        jQuery('#lightgallery').lightGallery();
    });
</script>

<link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/lightgallery/1.3.9/js/lightgallery.min.js"></script>
@endsection
