@extends('frontend.layouts.master')
@section('metas')
    {!! metas([
    'title' => $page->seo_title ?? NULL,
    'description' => $page->seo_description ?? Null,
    'keywords' => $page->seo_keywords ?? Null,
    'url' => null,
    'img_url' => null
    ]) !!}
@endsection
@section('content')
    @if(!empty($page->template))
        @include('frontend.templates.page.' . $page->template)
    @else
        @if($page->which_editor == 'grapes')
            <div class="container">
                {!! $page->grapes_description !!}
                <style>
                    {!! $page->grapes_css !!}
                </style>
            </div>
        @else
            <div class="container">
                <h1 style="border-bottom: 1px dotted #ccc; padding: 14px 0px; font-size: 25px;">{!! $page->title ?? NULL !!}</h1>
                {!! $page->description ?? NULL !!}
            </div>
        @endif
    @endif
@endsection
