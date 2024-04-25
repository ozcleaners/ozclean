@extends('frontend.layouts.master')
@section('metas')
    {!! metas([
        'title' => $seo_information->meta_title ?? ($term_custom_field->content_title ?? NULL),
        'description' => $seo_information->meta_description ?? ($term_custom_field->content_short_details ?? NULL),
        'keywords' => $seo_information->meta_keywords ?? ($term_custom_field->content_title ?? NULL),
        'url' => null,
        'img_url' => null
        ]) !!}
@endsection
@section('content')
    <div class="container-fluid white_shape"
         style="background: url({{ $Media::fullSize($term_custom_field->content_page_banner ?? NULL) }});
             max-height: 500px; min-height: 480px; background-position: center;align-items: center; display: flex;">
        <div class="row m-0 justify-content-center">
            <div class="xcontainer col-lg-10">
                <div class="col-md-6 text-white p40" style="position: relative; z-index: 101">
                    <h1 class="service_title">
                        {{--                    @dump($term_custom_field)--}}
                        {!! $term_custom_field->content_title ?? null  !!}
                    </h1>
                    <h2 class="service_subtitle">
                        {!! $term_custom_field->content_sub_title ?? null !!}
                    </h2>
                    <p class="service_short_details">
                        {!! $term_custom_field->content_details ?? null !!}
                    </p>
                    {{--                <p>--}}
                    {{--                    <a href="#form" class="btn btn-success">Book now</a>--}}
                    {{--                </p>--}}
                </div>
            </div>
        </div>
    </div>
    {{--    <svg width="100%" height="150" viewBox="0 0 500 150" preserveAspectRatio="none">--}}
    {{--        <path d="M0,150 L0,40 Q250,150 500,40 L580,150 Z" fill="white"></path>--}}
    {{--    </svg>--}}
{{--    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 280">--}}
{{--        <path fill="#ffffff" fill-opacity="1" d="M0,128L480,224L960,256L1440,64L1440,320L960,320L480,320L0,320Z"></path>--}}
{{--    </svg>--}}

    <div class="single-service-content">
        {{--                    <div class="row">--}}
        {{--                        <div class="col-md-12">--}}
        {{--                            {!! $term->description ?? null !!}--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        @php
//            dump(request()->zone);
            $contents = $Model('TermCustomField')::where('content_term_id', $term->id ?? NULL)
                            ->where('content_for', 'Term')
                            ->where('content_zone', ucwords(request()->zone))
                            ->orderBy('sorting_order', 'ASC')->get();
        @endphp

        @foreach($contents as $key => $content)
            {{--            @dump($term->id ?? NULL)--}}
            @include('frontend.service_page_segment.left_image_content')
            @include('frontend.service_page_segment.left_image_content_wt')
            @include('frontend.service_page_segment.right_image_content')
            @include('frontend.service_page_segment.right_image_content_wt')
            @include('frontend.service_page_segment.call_to_action_text_type')
            @include('frontend.service_page_segment.why-choose-us')
            @include('frontend.service_page_segment.side_by_side_bullet_type')
            @include('frontend.service_page_segment.before_after')
            @include('frontend.service_page_segment.featured_bullet_type')
            @include('frontend.service_page_segment.text_type')
            @include('frontend.service_page_segment.extra_service_list')
            @include('frontend.service_page_segment.text_type_without_title')
            {{--            @include('frontend.service_page_segment.extra_service_bullet_type')--}}
            {{--            @include('frontend.service_page_segment.vertical_tabs')--}}
            {{--            @include('frontend.service_page_segment.multiple_image_type')--}}
            {{--            @include('frontend.service_page_segment.tabs_type')--}}
        @endforeach
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
        .im-centered {
            margin: auto;
            max-width: 1000px;
        }

        svg {
            z-index: 100;
            position: relative;
            margin-top: -450px;
        }

        div.subsection_gap {
            min-height: 200px;
            overflow: hidden;
            border: 1px solid #f9f9f9;
            margin-bottom: 15px;
            border-radius: 5px;
            justify-content: center;
            align-items: center;
            vertical-align: middle;
        }

        h5.service_subsection_title {
            font-size: 20px;
            font-weight: bold;
            padding: 0 0 10px 0;
        }

        .before_after .gallery {
            position: relative;
            z-index: 2;
            padding: 10px 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            /*justify-content: space-between;*/
            -webkit-transition: all .5s ease-in-out;
            transition: all .5s ease-in-out;
        }

        .before_after .gallery figure {
            /*-ms-flex-preferred-size: 33.333%;*/
            /*flex-basis: 33.333%;*/
            /*flex: 1;*/
            padding: 10px;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
        }

        .before_after .gallery figure img {
            width: 100%;
            border-radius: 10px;
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }

        .before_after .gallery figure figcaption {
            display: none;
        }


        .side_by_side_bullets ul li::before {
            content: "\2713\0020";
            margin-right: 7px;
            background: #5cb85c;
            border-radius: 50%;
            display: inline-block;
            width: 20px;
            height: 20px;
            top: 13px;
            vertical-align: unset;
            color: #FFFFFF;
            align-items: flex-start;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        div.side_by_side_bullets ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
            list-style: none;
        }

        div.side_by_side_bullets ul li {
            margin: 0;
            padding: 0;
            list-style-type: none;
            list-style: none;
            padding: 5px 0px;
        }

        .term_page_heading {
            font-size: 20px;
        }

        .term_page_heading span {
            color: #007cfb;
        }

        .term_page_sub_heading {
            font-size: 15px;
        }

        .single-service-title {
            font-size: 25px;
        }

        .tabs-left > .nav-tabs {
            border-bottom: 0;
        }

        .tab-content > .tab-pane,
        .pill-content > .pill-pane {
            display: none;
        }

        .tabs-left > .nav-tabs > li {
            float: none;
        }

        .tabs-left > .nav-tabs > li > a {
            min-width: 74px;
            margin-right: 0;
            margin-bottom: 3px;
        }

        .tabs-left > .nav-tabs {
            float: left;
            margin-right: 19px;
            border-right: 1px solid #ddd;
            display: block;
            min-height: 350px;
        }

        .tabs-left > .nav-tabs > li > a {
            margin-right: -1px;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .tabs-left > .nav-tabs > li > a:hover,
        .tabs-left > .nav-tabs > li > a:focus {
            border-color: #eeeeee #dddddd #eeeeee #eeeeee;
        }

        .tabs-left > .nav-tabs .active > a,
        .tabs-left > .nav-tabs .active > a:hover,
        .tabs-left > .nav-tabs .active > a:focus {
            border-color: #ddd transparent #ddd #ddd;
            border-right-color: #ffffff;
            background: #007cfb;
            color: #fff;
        }

        .tab-content > .tab-pane,
        .pill-content > .pill-pane {
            display: none;
        }

        .tab-pane ul, .tab-pane ol {
            margin-left: 20px;
        }

        .tab-content > .active,
        .pill-content > .active {
            display: block;
        }

        .card {
            border: none !important;
        }


        /** Vertical Tabs **/

        /*  bhoechie tab */
        div.bhoechie-tab-container {
            z-index: 10;
            background-color: #ffffff;
            padding: 0 !important;
            border-radius: 4px;
            -moz-border-radius: 4px;
            border: 1px solid #ddd;
            margin-top: 20px;
            margin-left: 0px;
            background-clip: padding-box;
            opacity: 0.97;
            filter: alpha(opacity=97);
        }

        div.bhoechie-tab-menu {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;
        }

        div.bhoechie-tab-menu div.list-group {
            margin-bottom: 0;
        }

        div.bhoechie-tab-menu div.list-group > a {
            margin-bottom: 0;
        }

        div.bhoechie-tab-menu div.list-group > a .glyphicon,
        div.bhoechie-tab-menu div.list-group > a .fa {
            color: #5A55A3;
        }

        div.bhoechie-tab-menu div.list-group > a:first-child {
            border-top-right-radius: 0;
            -moz-border-top-right-radius: 0;
        }

        div.bhoechie-tab-menu div.list-group > a:last-child {
            border-bottom-right-radius: 0;
            -moz-border-bottom-right-radius: 0;
        }

        div.bhoechie-tab-menu div.list-group > a.active,
        div.bhoechie-tab-menu div.list-group > a.active .glyphicon,
        div.bhoechie-tab-menu div.list-group > a.active .fa {
            background-color: #dff0d8;
            color: #000000;
            text-shadow: none;
            background-image: none;
            border-color: #dff0d8 !important;
        }

        div.bhoechie-tab-menu div.list-group > a.active:after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            margin-top: -13px;
            border-left: 0;
            border-bottom: 13px solid transparent;
            border-top: 13px solid transparent;
            border-left: 10px solid #dff0d8;
        }

        div.bhoechie-tab-content {
            background-color: #ffffff;
            /* border: 1px solid #eeeeee; */
            padding-left: 20px;
            padding-top: 10px;
        }

        div.bhoechie-tab div.bhoechie-tab-content:not(.active) {
            display: none;
        }

        .bhoechie-tab-menu .list-group-item {
            border: none;
            border-right: 1px solid #ddd;
            margin-right: -1px;
        }
    </style>
    <script>
        let imgClassLeft = $('.single-service-content img[alt="my_class_left"]').prop('alt');
        $('.single-service-content img[alt="my_class_left"]').addClass(imgClassLeft);

        let imgClassRight = $('.single-service-content img[alt="my_class_right"]').prop('alt');
        $('.single-service-content img[alt="my_class_right"]').addClass(imgClassRight);

        $(document).ready(function () {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
        });
    </script>
@endsection

{{--Tabs--}}
{{--                        @include('frontend.service_page_segment.tabs_type')--}}
{{-- Featured Bullet Type--}}
{{--                        @include('frontend.service_page_segment.featured_bullet_type')--}}
{{-- Vertical Tabs Inclusion --}}
{{--                        @include('frontend.service_page_segment.vertical_tabs')--}}
{{--Call To Action--}}
{{--Extra Services Bullet Type--}}
{{--                        @include('frontend.service_page_segment.extra_service_bullet_type')--}}
