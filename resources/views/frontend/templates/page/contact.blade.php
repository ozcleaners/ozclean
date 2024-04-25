@extends('frontend.layouts.master')
@section('metas')
        @php
            $pages = $Model('Page')::where('seo_url', 'contact-us')->first()
        @endphp
        @if($pages)
            {!! metas([
          'title' => $pages->seo_title ?? NULL,
          'description' => $pages->seo_description ?? Null,
          'keywords' => $pages->seo_keywords ?? Null,
          'url' => null,
          'img_url' => null
          ]) !!}
        @endif

{{--    <title> OZ Cleaners | Contact us </title>--}}
{{--    <meta name="description" content="Oz Cleaners always ready to help. You can email us for anything related to cleaning service or property maintenance from anywhere in Australia  ">--}}
{{--    <meta name="keywords" content="Residential cleaning, Commercial cleaning, Exterior cleaning, Interior cleaning, End of Lease Cleaning, Window cleaning, Solar panel cleaning, Strata Cleaning, High pressure cleaning, After builders cleaning, Renovation cleaning, Gutter cleaning, carpet steam cleaning, oven cleaning, BBQ cleaning, Spring cleaning, Regular house cleaning, Regular office cleaning, roof cleaning, roof painting">--}}
{{--    <link href="https://ozcleaners.com.au/contact" rel="canonical">--}}
{{--    <meta name="author" content="Oz Cleaners">--}}
{{--    <meta name="zone" content="Australia">--}}
@endsection

@php
    $global_setting = $Model('GlobalSetting')::first();
    //dd($global_setting);
@endphp
@section('content')
    <div class="heading-4"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mobile-top-spacer"></div>
                <div class="section-heading">
                    <div class="heading-with-icon-wrap">
                        <h1 class="heading-with-icon-inner section-name-text">
                            <div class="heading-icon"></div>
                            {{ $Query::frontendSettings('page_title') }}
                        </h1>
                    </div>

                    <h3 class="contact-info-content-title st-default">
                        <span>{{ $Query::frontendSettings('page_subtitle') }}</span>
                    </h3>
                </div>
                <div class="contact-form-short-ifo">
                    {{ $Query::frontendSettings('short_details') }}
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="contact-info-box">
                            <div class="contact-info-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="contact-info-content-wrap">
                                <h3 class="contact-info-content-title ">Phone Number:</h3>
                                <div class="contact-info-content-description">
{{--                                    Head office: {{ $global_setting->phone ?? NULL }}--}}
{{--                                    <br>--}}
                                    Help line: {{ $global_setting->order_phone ?? NULL }}
                                </div>
                            </div>
                        </div>
                        <div class="contact-info-box">
                            <div class="contact-info-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="contact-info-content-wrap">
                                <h3 class="contact-info-content-title">Email us:</h3>
                                <div class="contact-info-content-description">
                                    {{ $global_setting->email ?? NULL }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="contact-info-box contact-info-box-layout1 style3 ">
                            <div class="contact-info-icon">
                                <i class="fa fa-clock"></i>
                            </div>
                            <div class="contact-info-content-wrap">
                                <h3 class="contact-info-content-title">Opening time:</h3>
                                <div class="contact-info-content-description">
                                    {{ $global_setting->working_hours ?? NULL }}
                                </div>
                            </div>
                        </div>
                        <div class="contact-info-box contact-info-box-layout1 style3 ">
                            <div class="contact-info-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="contact-info-content-wrap">
                                <h3 class="contact-info-content-title">Location:</h3>
                                <div class="contact-info-content-description">
                                    {{ $global_setting->address ?? NULL }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="heading-4"></div>
                <form method="post" class="contact-form-wrap" action="{{ route('frontend_contact') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <span class="form-field-wrap">
                                <input type="text" value="" name="first_name" class="contact-form-wrap-control"
                                       placeholder="First name*" required>
                            </span>
                        </div>
                        <div class=" col-lg-6 col-md-6">
                            <span class="form-field-wrap">
                                <input type="text" value="" name="last_name" class="contact-form-wrap-control"
                                       placeholder="Last name*" required>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-6 col-md-6">
                            <span class="form-field-wrap">
                                <input type="email" value="" name="email" class="contact-form-wrap-control"
                                       placeholder="Email*" required>
                            </span>
                        </div>
                        <div class=" col-lg-6 col-md-6">
                            <span class="form-field-wrap">
                                <input type="text" value="" name="phone" class="contact-form-wrap-control"
                                       placeholder="Phone Number*" required>
                            </span>
                        </div>
                    </div>
                    <span class="form-field-wrap">
                        <input type="text" value="" name="subject" class="contact-form-wrap-control"
                               placeholder="Subject*"
                               required>
                    </span>
                    <span class="form-field-wrap">
                        <textarea rows="10" name="message" class="comment-field" placeholder="Message..."></textarea>
                    </span>
                    <div class="form-field-wrap">
                        <button type="submit" class="contact-form-submit-button btn">
                            Send us message
                        </button>
                    </div>
                </form>
                @isset($message)
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endisset
            </div>
        </div>
    </div>


    <div class="row-spacer"></div>

    <div class="container-fluid">
        <div class="row">
            {!! $global_setting->google_map ?? NULL !!}
        </div>
    </div>

    <div style="margin-bottom: -8px;"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="styled-content-box">
                <div class="styled-content-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 padding-left">
                                <h3 class="styled-content-title">
                                    {{ $Query::frontendSettings('contact_us_cta') }}
                                </h3>
                                <p class="styled-content-info">
                                    {{ $Query::frontendSettings('contact_us_cta_details') }}
                                </p>
                                <a href="{{ $Query::frontendSettings('contact_us_cta_url') }}"
                                   class="btn btn-primary styled-content-button">
                                    {{ $Query::frontendSettings('contact_us_cta_button_text') }}
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="row-spacer"></div>


    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="heading-with-subtitle">
                    <h1 class="heading-text">
                        <span> {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->name }} </span>
                    </h1>
                </div>
                <div class="basic-text-block">
                    {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->term_subtitle }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="postbox owl-carousel">
                    @php
                        $blogs = function($position = []) use($Post, $Query) {
                             $get = $Post::category($Query::frontendSettings('home_blogs'));
                             return $get->whereIn('position', $position)->get();
                           };
                    @endphp
                    @foreach ($blogs(['Left']) as $post)
                        <div class="postbox-wrap">
                            <div class="postbox-thumbnail">
                                <a href="{{route('frontend_blog', $post->seo_url)}}">
                                    <img class="img-responsive" src="{{$Media::fullSize($post->images)}}"
                                         alt="{!! $post->title !!}">
                                </a>
                            </div>
                            <div class="postbox-content">
                                <div class="postbox-content-inner">
                                    <ul class="postbox-content-meta" style="">
                                        <li class="postbox-content-date">
                                            <i class="fa fa-calendar"></i>{{$post->created_at->format('M d, Y')}}
                                        </li>
                                    </ul>
                                    <h3 class="postbox-content-heading">
                                        <a href="{{route('frontend_blog', $post->seo_url)}}">{!! $post->title !!}</a>
                                    </h3>
                                    <div class="postbox-content-readmore">
                                        <a href="{{route('frontend_blog', $post->seo_url)}}">
                                            Read more
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                @foreach ($blogs(['Right']) as $post)
                    <div class="latest-vertical-blog unique-style">
                        <div class="vertical-blog-inner">
                            <div class="vertical-blog-thumb">
                                <a href="{{route('frontend_blog', $post->seo_url)}}">
                                    <img class="img-responsive" src="{{$Media::fullSize($post->images)}}"
                                         alt="{!! $post->title !!}">
                                </a>
                            </div>
                            <div class="vertical-blog-content">
                                <h6 class="vertical-blog-title">
                                    <a href="{{route('frontend_blog', $post->seo_url)}}">{!! $post->title !!}</a>
                                </h6>
                                <ul class="vertical-blog-meta">
                                    <li class="vertical-blog-meta-date">
                                        <i class="fa fa-calendar"></i> {{$post->created_at->format('M d, Y')}}
                                    </li>
                                    {{-- <li class="vertical-blog-meta-comment">
                                       <i class="fa fa-comment"></i> 2 Comments
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{--    <div class="container">--}}

    {{--        <div class="row">--}}
    {{--            <div class="col-md-6">--}}
    {{--                <div class="heading-with-icon">--}}
    {{--                    <div class="heading-with-icon-wrap">--}}
    {{--                        <div class="heading-with-icon-inner">--}}
    {{--                            <div class="heading-icon"></div>--}}
    {{--                            {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->name }}--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <h3 class="heading-with-icon-text">--}}
    {{--                        <span>--}}
    {{--                            {{ $Term::getContent($Query::FrontendSettings('home_blogs'))->term_subtitle }}</small>--}}
    {{--                        </span>--}}
    {{--                    </h3>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}


    {{--        <div class="row row-spacer-short">--}}
    {{--            <div class="postbox-3col owl-carousel">--}}

    {{--                @php--}}
    {{--                    $blogs = function () use ($Post, $Query) {--}}
    {{--                        $get = $Post::category($Query::frontendSettings('home_blogs'));--}}
    {{--                        return $get->where('is_sticky', 1)->get();--}}
    {{--                    };--}}
    {{--                @endphp--}}
    {{--                @foreach ($blogs(['Left']) as $post)--}}
    {{--                    <div class="postbox-wrap">--}}
    {{--                        <div class="postbox-thumbnail">--}}
    {{--                            <a href="{{ route('frontend_blog', $post->seo_url) }}">--}}
    {{--                                <img class="img-responsive" src="{{ $Media::fullSize($post->images) }}" alt="">--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="postbox-content">--}}
    {{--                            <div class="postbox-content-inner">--}}
    {{--                                <ul class="postbox-content-meta" style="">--}}
    {{--                                    <li class="postbox-content-date">--}}
    {{--                                        <i class="fa fa-calendar"></i>{{ $post->created_at->format('M d, Y') }}--}}
    {{--                                    </li>--}}
    {{--                                </ul>--}}
    {{--                                <h3 class="postbox-content-heading">--}}
    {{--                                    <a href="{{ route('frontend_blog', $post->seo_url) }}">--}}
    {{--                                        {{ $post->title }}--}}
    {{--                                    </a>--}}
    {{--                                </h3>--}}
    {{--                                <div class="postbox-content-readmore">--}}
    {{--                                    <a href="{{ route('frontend_blog', $post->seo_url) }}">--}}
    {{--                                        Read more <i class="fa fa-angle-double-right" aria-hidden="true"></i>--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--            @endforeach--}}



    {{--            <!-------- POST BOX ITEM -------->--}}
    {{--                <div class="postbox-wrap">--}}
    {{--                    <div class="postbox-thumbnail">--}}
    {{--                        <a href="#">--}}
    {{--                            <img class="img-responsive" src="{{ $publicDir }}/frontend/img/owl-carousel/c2.jpg" alt="">--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                    <div class="postbox-content">--}}
    {{--                        <div class="postbox-content-inner">--}}
    {{--                            <ul class="postbox-content-meta" style="">--}}
    {{--                                <li class="postbox-content-date">--}}
    {{--                                    <i class="fa fa-calendar"></i>August 17, 2020--}}
    {{--                                </li>--}}
    {{--                                <li class="postbox-content-author">--}}
    {{--                                    <a href="#"><i class="fa fa-user"></i>Tritiyo Limited</a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                            <h3 class="postbox-content-heading">--}}
    {{--                                <a href="#">How stay calm from the first time.</a>--}}
    {{--                            </h3>--}}
    {{--                            <div class="postbox-content-readmore">--}}
    {{--                                <a href="#"> Read more <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <!-------- POST BOX ITEM -------->--}}
    {{--                <div class="postbox-wrap">--}}
    {{--                    <div class="postbox-thumbnail">--}}
    {{--                        <a href="#">--}}
    {{--                            <img class="img-responsive" src="{{ $publicDir }}/frontend/img/owl-carousel/c3.jpg" alt="">--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                    <div class="postbox-content">--}}
    {{--                        <div class="postbox-content-inner">--}}
    {{--                            <ul class="postbox-content-meta" style="">--}}
    {{--                                <li class="postbox-content-date">--}}
    {{--                                    <i class="fa fa-calendar"></i>August 17, 2020--}}
    {{--                                </li>--}}
    {{--                                <li class="postbox-content-author">--}}
    {{--                                    <a href="#"><i class="fa fa-user"></i>Tritiyo Limited</a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                            <h3 class="postbox-content-heading">--}}
    {{--                                <a href="#">How stay calm from the first time.</a>--}}
    {{--                            </h3>--}}
    {{--                            <div class="postbox-content-readmore">--}}
    {{--                                <a href="#"> Read more <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <!-------- POST BOX ITEM -------->--}}
    {{--                <div class="postbox-wrap">--}}
    {{--                    <div class="postbox-thumbnail">--}}
    {{--                        <a href="#">--}}
    {{--                            <img class="img-responsive" src="{{ $publicDir }}/frontend/img/owl-carousel/c3.jpg" alt="">--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                    <div class="postbox-content">--}}
    {{--                        <div class="postbox-content-inner">--}}
    {{--                            <ul class="postbox-content-meta" style="">--}}
    {{--                                <li class="postbox-content-date">--}}
    {{--                                    <i class="fa fa-calendar"></i>August 17, 2020--}}
    {{--                                </li>--}}
    {{--                                <li class="postbox-content-author">--}}
    {{--                                    <a href="#"><i class="fa fa-user"></i>Tritiyo Limited</a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                            <h3 class="postbox-content-heading">--}}
    {{--                                <a href="#">How stay calm from the first time.</a>--}}
    {{--                            </h3>--}}
    {{--                            <div class="postbox-content-readmore">--}}
    {{--                                <a href="#"> Read more <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <!-------- POST BOX REPEATER -------->--}}


    {{--            </div>--}}
    {{--        </div>--}}

    {{--    </div>--}}
@endsection
