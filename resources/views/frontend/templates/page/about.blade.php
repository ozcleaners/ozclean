@extends('frontend.layouts.master')
{!! metas([
    [
        'title' => 'About Us',
        'description' => 'About us',
        'keywords' => null,
        'url' => null,
        'img_url' => null,
    ],
]) !!}

@php
	$global_setting = $Query::accessModel('GlobalSetting')::first();	
@endphp

@section('content')
    @if(!empty($page->template))
        @include('frontend.templates.page.' . $page->template)
    @else
        
        @if($page->which_editor == 'grapes')
            {{-- {!! $page->grapes_description !!}            
            <style>
                {!! $page->grapes_css !!}
            </style> --}}
        @else
            <div class="container">
                <h4 style="border-bottom: 1px dotted #ccc; padding: 14px 0px; font-size: 23px;">{!! $page->title !!}</h4>
                {!! $page->description !!}
            </div>
        @endif
    @endif
@endsection