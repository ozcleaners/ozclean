@extends('frontend.layouts.master')
{!! metas([[
    'title' => 'Albums',
    'description' => 'take a look on albums',
    'keywords' => null,
    'url' => null,
    'img_url' => null
    ]]) !!}
@section('content')

    <div class="container">

        <nav aria-label="breadcrumb" class="my-4">
            <ol class="row breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gallery</li>
            </ol>
            <h2>{{ $albumName[0]->name }}</h2>
        </nav>

        <div class="album-photo-gallery">
            <ul id="lightgallery" class="list-unstyled row">
                @foreach($albumPhoto as $photos)
                    @php
                        $img = $Query::accessModel('Media')::where('id', $photos->media_id)->get()->first();
                        //dump($img);
                    @endphp
                    <li class="col-md-3 col-12" data-responsive="{{url('/')}}/{{$img->full_size_directory}}" data-src="{{url('/')}}/{{$img->full_size_directory}}" data-sub-html="<h4>{{$photos->caption}}</h4>">
                        <a href="">
                            <img class="img-fluid" src="{{url('/')}}/{{$img->full_size_directory}}">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div><!-- End gallery-->
    </div>
    <link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">

@endsection

@section('cusjs')
    <script>
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
    </script>
    <script src="{{$publicDir}}/frontend/js/gallery-lightbox.js"></script>
@endsection
