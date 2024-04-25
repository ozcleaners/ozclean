@extends('frontend.layouts.master')

@section('metas')
    @php
        $pages = $Model('Page')::where('seo_url', 'blogs')->first()
    @endphp
    @if($pages)
        {!! metas([
          'title' => $pages->seo_title ?? NULL,
          'description' => $pages->seo_description ?? NULL,
          'keywords' => $pages->seo_keywords ?? NULL,
          'url' => NULL,
          'img_url' => NULL
      	]) !!}
    @endif

{{--    <title> OZ Cleaners | Know how our professionals works with pro tips</title>--}}
{{--    <meta name="description" content=": We provide regular cleaning tips to help you do a job professionally by yourself. Choice is yours to hire a professional cleaning service provider or not, we are always beside you. ">--}}
{{--    <meta name="keywords" content="Residential cleaning, Commercial cleaning, Exterior cleaning, Interior cleaning, End of Lease Cleaning, Window cleaning, Solar panel cleaning, Strata Cleaning, High pressure cleaning, After builders cleaning, Renovation cleaning, Gutter cleaning, carpet steam cleaning, oven cleaning, BBQ cleaning, Spring cleaning, Regular house cleaning, Regular office cleaning, roof cleaning, roof painting">--}}
{{--    <link href="https://ozcleaners.com.au/blogs" rel="canonical">--}}
{{--    <meta name="author" content="Oz Cleaners">--}}
{{--    <meta name="zone" content="Australia">--}}
@endsection

@section('content')
    <div id="pagetitle" class="page-title bg-image ">
        <div class="container">
            <div class="page-title-inner">
                <div class="image-overlay"></div>
                <div class="page-title-holder">
                    <h1 class="page-title">
                        {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->name }}
                    </h1>
                </div>
                {{--                <ul class="ct-breadcrumb">--}}
                {{--                    <li><a class="breadcrumb-entry" href="https://demo.casethemes.net/bixol/">Home</a></li>--}}
                {{--                    <li><span class="breadcrumb-entry">Blog Grid 2 Columns Sidebar Left</span></li>--}}
                {{--                </ul>--}}
            </div>
        </div>
    </div>
    <div id="content" class="site-content ">
        <div class="container">
            <div class="row">
                <div id="primary"
                     class="content-area content-has-sidebar float-right col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <div class="postbox">
                    @php
                        $blogs = function () use ($Post, $Query) {
                            $get = $Post::category($Query::frontendSettings('home_blogs'));
                            return $get->orderBy('id', 'desc')->get();
                        };
                    @endphp
                    <!-------- POST BOX ITEM -------->
                        @foreach ($blogs() as $post)
                            <div class="col-md-6">
                                <div class="postbox-wrap">
                                    <div class="postbox-thumbnail">
                                        <a href="{{ route('frontend_blog', $post->seo_url) }}">
                                            <img class="img-responsive" src="{{ $Media::fullSize($post->images) }}"
                                                 alt="">
                                        </a>
                                    </div>
                                    <div class="postbox-content">
                                        <div class="postbox-content-inner">
                                            <ul class="postbox-content-meta" style="">
                                                <li class="postbox-content-date">
                                                    <i class="fa fa-calendar"></i>{{ $post->created_at->format('M d, Y') }}
                                                </li>
                                                <li class="postbox-content-author">
                                                    <a href="#"><i class="fa fa-user"></i></a>
                                                </li>
                                            </ul>
                                            <h3 class="postbox-content-heading">
                                                <a href="{{ route('frontend_blog', $post->seo_url) }}">{{ $post->title }}</a>
                                            </h3>
                                            <div class="postbox-content-readmore">
                                                <a href="{{ route('frontend_blog', $post->seo_url) }}"> Read more <i
                                                        class="fa fa-angle-double-right" aria-hidden="true"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <aside id="secondary"
                       class="widget-area widget-has-sidebar sidebar-fixed col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    <div id="categories-4" class="widget widget_categories">
                        <div class="widget-content"><h2 class="widget-title"><span>Categories</span></h2>
                            <ul>
                                <li class="cat-item cat-item-7"><a
                                        href="https://demo.casethemes.net/bixol/category/apartment-cleaning/">Apartment
                                        <span
                                            class="count">(2) </span></a></li>
                                <li class="cat-item cat-item-6"><a
                                        href="https://demo.casethemes.net/bixol/category/carpet-cleaning/">Carpet <span
                                            class="count">(1) </span></a></li>
                                <li class="cat-item cat-item-1"><a
                                        href="https://demo.casethemes.net/bixol/category/curtain-cleaning/">Curtain
                                        <span
                                            class="count">(1) </span></a></li>
                                <li class="cat-item cat-item-5"><a
                                        href="https://demo.casethemes.net/bixol/category/office-cleaning/">Office <span
                                            class="count">(3) </span></a></li>
                                <li class="cat-item cat-item-4"><a
                                        href="https://demo.casethemes.net/bixol/category/window-cleaning/">Window <span
                                            class="count">(2) </span></a></li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
@section('cusjs')
    <style>
        body #pagetitle.page-title {
            background-image: url('https://demo.casethemes.net/bixol/wp-content/uploads/2020/11/page-title-update.jpg');
        }

        .site-content {
            padding: 110px 0 170px;
            position: relative;
        }

        #pagetitle {
            background-color: #0e0e0e;
            padding: 110px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        #pagetitle:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-color: rgba(3, 0, 20, .67);
        }

        #pagetitle .page-title {
            color: #fff;
            font-size: 60px;
            margin-bottom: 0;
        }

        #secondary .widget {
            margin-bottom: 40px;
            border: 1px solid #f3f3f3;
            padding: 40px;
        }

        #secondary .widget .widget-title {
            font-size: 20px;
            margin-bottom: 28px;
        }

        #secondary .widget .widget-title span {
            padding-right: 40px;
            position: relative;
            display: inline-block;
        }

        #secondary .widget .widget-title span:before {
            content: '';
            width: 27px;
            height: 3px;
            position: absolute;
            top: 50%;
            right: 0;
            -webkit-transform: translate(0, -50%);
            -khtml-transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
            -ms-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
            background-color: #007cfb;
        }

        #content .widget_categories li a {
            color: #082680;
            display: block;
            font-size: 15px;
            font-weight: 600;
            line-height: normal;
            padding: 14px 40px 14px 0;
            position: relative;
            position: relative;
            z-index: 1;
            border-bottom: 1px solid #f6f6f6;
        }

        #content .widget_product_categories ul li a:after, #content .widget_categories ul li a:after, #content .widget_nav_menu ul li a:after, #content .widget_pages ul li a:after, #content .widget_archive ul li a:after, #content .widget_meta ul li a:after, #content .widget_recent_entries ul li a:after {
            content: '\f105';
            font-family: "font awesome 5 pro";
            font-weight: 900;
            color: inherit;
            -webkit-transition: all 240ms linear 0ms;
            -khtml-transition: all 240ms linear 0ms;
            -moz-transition: all 240ms linear 0ms;
            -ms-transition: all 240ms linear 0ms;
            -o-transition: all 240ms linear 0ms;
            transition: all 240ms linear 0ms;
            position: absolute;
            top: 50%;
            right: 0;
            -webkit-transform: translate(0, -50%);
            -khtml-transform: translate(0, -50%);
            -moz-transform: translate(0, -50%);
            -ms-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }

        ul {
            padding: 0;
            margin: 0 0 32px;
        }

        .widget_categories ul, .widget_nav_menu ul, .widget_pages ul, .widget_archive ul, .widget_meta ul {
            list-style: none;
            margin-bottom: 0;
        }
    </style>
@endsection

