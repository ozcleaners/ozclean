@extends('frontend.layouts.master')
@section('metas')
@endsection
{{--@php--}}
{{--    if (!empty(request()->get('album'))) {--}}
{{--        $albums = $this->Query::accessModel('Gallery')::where('gallery_for', 'Service')->groupBy('parent_category_id')->get();--}}
{{--        $sub_albums = $this->Query::accessModel('Gallery')::where('parent_category_id', request()->get('album'))->get();--}}
{{--    } else {--}}
{{--        $albums = $this->Query::accessModel('Gallery')::where('gallery_for', 'Service')->groupBy('parent_category_id')->get();--}}
{{--        $sub_albums = null;--}}
{{--    }--}}
{{--@endphp--}}
@section('content')
    <div class="container">
        <h4 class="ml-3" style="border-bottom: 1px dotted #ccc; padding: 14px 0px; font-size: 23px;">
            Service Gallery
        </h4>
        <div class="row">
            <div class="col-md-3" id="secondary">
                <div id="categories-3" class="widget widget_categories">
                    <div class="widget-content">
                        {{--    <h2 class="widget-title"><span>Categories</span></h2>--}}

                        <ul>
                            @php
                                if(count($albums) > 0){
                                    $defaultParentTerm = $albums[0]->parent_category_id;
                                    $parent_term = $parent_term ?? $defaultParentTerm;
                                }
                            @endphp
                            @foreach($albums as $key => $album)
                                @php
                                    $album_info = $Query::accessModel('Term')::where('id', $album->parent_category_id)->first();
                                    $img_id = $album_info->onpage_banner ?? NULL;
                                    $term_name = $album_info->name ?? NULL;
                                    $term_seo_url = $album_info->seo_url ?? NULL;
                                @endphp
                                <li class="cat-item cat-item-7">
                                    <a href="{{route('frontend_service_parent_albums', [$term_seo_url])}}"
                                       xhref="{{ route('frontend_service_albums',) }}?album={{$album->parent_category_id}}"
                                       class="{{isset($parent_term) && $parent_term == $album->parent_category_id ? 'text-success' :  null}}">
                                        {!! $term_name !!}
                                    </a>
                                    @php
                                        $sub_album = $Query::accessModel('Gallery')::where('parent_category_id', $album->parent_category_id)
                                                        ->where('gallery_for', 'Service')
                                                        ->groupBy('category_id')
                                                        ->get();
                                    @endphp
                                    <ul class="widget-sub">
                                        @foreach ($sub_album as $k => $sAlbum)
                                            <li>
                                                @php
                                                    $sAlbumName = $Query::accessModel('Term')::where('id', $sAlbum->category_id)->first()->name ?? NULL;
                                                    $sAlbumSeoUrl = $Query::accessModel('Term')::where('id', $sAlbum->category_id)->first()->seo_url ?? NULL;
                                                @endphp
                                                <a href="{{route('frontend_service_parent_albums', [$term_seo_url, $sAlbumSeoUrl])}}"
                                                   type="button"
                                                   class="{{isset($parent_sub_term) && $parent_sub_term == $sAlbum->category_id ? 'text-success' :  null}}">
                                                    {{ $sAlbumName }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @php
                    if(isset($photos)){
                    } else {
                        if(isset($defaultParentTerm)){
                            request()->request->add(['album' => $defaultParentTerm]);
                            if(request()->get('album')){
                                $sub_albums = $Model('Gallery')::where('parent_category_id', request()->get('album'))->get();
                            }
                        }
                    }
                @endphp
                @if(!empty(request()->get('album')) && count($sub_albums) > 0)
                    @foreach($sub_albums as $key => $sub_album)
                        <div class="col-md-4">
                            <a href="#">
                                <img src="{{ $Media::fullSize($sub_album->media_id) }}"
                                     alt="{{ $sub_album->caption ?? NULL }}"
                                     class="img-responsive service_gal_img" style="max-height: 300px;">

                                {{ $sub_album->caption ?? NULL }}
                            </a>
                        </div>
                    @endforeach
                @endif

                @if(isset($photos) && count($photos) > 0)
                    @foreach($photos as $key => $photo)
                        <div class="col-md-4">
                            <a href="{{ $Media::fullSize($photo->media_id) }}"
                               data-lightbox="example-set"
                               data-title="{{ $photo->caption ?? NULL }}">
                                <img src="{{ $Media::fullSize($photo->media_id) }}"
                                     alt="{{ $photo->caption ?? NULL }}"
                                     class="img-responsive service_gal_img" style="max-height: 300px;">

                                {{ $photo->caption ?? NULL }}
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@section('cusjs')
    <link rel="stylesheet" href="{{$publicDir}}/frontend/css/lightbox.min.css"/>
    <script type="text/javascript" src="{{$publicDir}}/frontend/js/lightbox-plus-jquery.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });
    </script>
    <style>
        #secondary .widget .widget-title {
            font-size: 20px;
            margin-bottom: 28px;
        }

        #secondary .widget {
            margin-bottom: 10px;
            border: 0px solid #f3f3f3;
            padding: 10px;
        }

        #secondary .widget .widget-title {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            margin-top: 0px;
        }

        #secondary .widget .widget-title span {
            padding-right: 40px;
            position: relative;
            display: inline-block;
        }

        #secondary .widget .widget-title span:after {
            content: '';
            width: 35px;
            height: 3px;
            position: relative;
            top: 50%;
            right: 0;
            -webkit-transform: translate(0, -50%);
            -khtml-transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
            -ms-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
            background-color: #007cfb;
            display: block;
            margin-top: 16px;
        }

        .widget .widget-content ul {
            list-style: none;
            margin-bottom: 0;
            padding-inline-start: 0px;
        }

        .widget .widget-content ul.widget-sub {
            list-style: none;
            margin-bottom: 0;
            padding-inline-start: 20px;
            background: #f9f9f9;
        }

        .widget .widget-content ul.widget-sub li {
            border-top: 1px solid #efefef;

        }

        .widget .widget-content ul.widget-sub li:first-child {
            margin-top: 14px;
            border-top: 1px solid #f6f6f6;
            padding-top: 14px;
        }

        .widget .widget-content ul.widget-sub li:last-child {
            border-bottom: 0px solid #f6f6f6;
            /*padding-bottom: 0px;*/
        }

        .widget .widget-content ul li {
            color: #333;
            display: block;
            font-size: 15px;
            font-weight: 500;
            line-height: normal;
            padding: 14px 14px 14px 0;
            position: relative;
            position: relative;
            z-index: 1;
            border-bottom: 1px solid #f6f6f6;
        }

        .widget .widget-content ul li:first-child {
            padding-top: 5px;
        }

        .widget .widget-content ul li a {
            color: #082680;
            text-decoration: none;
        }

        .widget .widget-content ul li a:hover {
            text-decoration: none;
            color: #0d6efd;
        }

        img.service_gal_img {
            height: 300px;
            width: 300px;
            object-position: center;
            object-fit: cover;
        }
    </style>
@endsection
