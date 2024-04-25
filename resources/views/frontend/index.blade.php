@extends('frontend.layouts.master')
@section('metas')

@endsection
@section('content')
    @include('frontend.homepage.banner')
    @include('frontend.homepage.our-service')
    @include('frontend.homepage.why-choose-us')
    @include('frontend.homepage.booking-steps')
    @include('frontend.homepage.testimonial')
    @include('frontend.homepage.counter')
    {{--    @include('frontend.homepage.partners')--}}
    @include('frontend.homepage.portfolio')
    @include('frontend.homepage.faq')
    @include('frontend.homepage.blog')
@endsection
