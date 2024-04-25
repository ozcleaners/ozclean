@extends('frontend.layouts.master')
{!! metas([[
    'title' => 'Albums',
    'description' => 'take a look on albums',
    'keywords' => null,
    'url' => null,
    'img_url' => null
    ]]) !!}
@section('content')
<div class="heading-4"></div>
    <div class="container">
    <div id="pagetitle" class="page-title bg-image ">
        <div class="container">
            <div class="page-title-inner">
                <div class="image-overlay"></div>
                <div class="page-title-holder"><h1 class="page-title">Photo Albums</h1></div>
            </div>
        </div>
    </div>
        <?php /*
        <div id="content" class="site-content ">
            <div class="content-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            @foreach($albums as $album)

                                <div class="col-lg-4 col-md-6 col-sm-12 col-12 py-3">
                                    <a class="text-white" href="{{ route('frontend_parent_album_photos' , $album->id) }}">
                                        <div class="card h-100 text-white bg-danger overflow-hidden">
                                            <div class="overlay-div"></div>
                                            @php
                                                $subAlbum = $Query::accessModel('Album')::where('albums_pcat_id', $album->id)->first() ?? NULL;
                                                //dd($subAlbum);
                                                $galleryFirstPhoto = $Query::accessModel('Gallery')::where('category_id', $subAlbum->id ?? NULL)->orderBy('id', 'DESC')->get()->first();
                                                $getImageById = $Query::accessModel('Media')::where('id', $galleryFirstPhoto['media_id'] ?? NULL)->get()->first();
                                            @endphp

                                            <div class="card-body py-5 album-card"
                                                 style="background-image: url('{{ url('/')}}/{{ $getImageById['icon_size_directory']}}'); background-size: cover;">
                                                <h4 class="card-title position-relative text-center">
                                                    {{ $album->name }}
                                                </h4>
                                            </div>
                                            <div
                                                class="card-footer text-center bg-danger position-relative font-weight-600">
                                                View all
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- #content inner -->
        </div>
        */ ?>
    <div class="portfolio-wrap">
        <div class="portfolio-grid" style="position: relative; height: 638.719px;">
                @foreach($albums as $album)
                <div class="portfolio-item portfolio-item-loader office-cleaning" style="width: 366px; position: absolute; left: 385px; top: 0px;">
                    @php
                        $subAlbum = $Query::accessModel('Album')::where('albums_pcat_id', $album->id)->first() ?? NULL;
                        //dd($subAlbum);
                        $galleryFirstPhoto = $Query::accessModel('Gallery')::where('category_id', $subAlbum->id ?? NULL)->orderBy('id', 'DESC')->get()->first();
                        $getImageById = $Query::accessModel('Media')::where('id', $galleryFirstPhoto['media_id'] ?? NULL)->get()->first();
                    @endphp
                    <div class="portfolio-item-inner">
                        <div class="portfolio-item-img">
                            <img class="img-responsive" src="{{ url('/')}}/{{ $getImageById['icon_size_directory']}}">
                        </div>
                        <div class="portfolio-content">
                            <div class="item-readmore-link">
                                <a href="{{ route('frontend_album_photos' , $album->id) }}">+</a>
                            </div>
                            <div class="item-title">
                                <h3 class="item-title-text"><a href="{{ route('frontend_album_photos' , $album->id) }}">{{ $album->name }}</a></h3>
                                <div class="item--divider"><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
@endsection
