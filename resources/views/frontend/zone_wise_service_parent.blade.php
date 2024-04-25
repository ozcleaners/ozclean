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
    <div class="container-fluid" style="background: #F8F9FB;padding: 0px 12px;box-sizing: border-box;">
        <div class="row m-0 justify-content-center">
            <div class="container col-lg-10" style="padding:10px;display:block">
                <h1 style="border-bottom: 1px dotted #ccc; padding: 14px 0px; margin: 20px 0px; font-size: 25px;">{{$term->name}}</h1>
                @if(count($parent_term_and_zone_wise_term_title) > 0)
                <div class="row">
                    @foreach ($parent_term_and_zone_wise_term_title as $key => $v)
                        @if($v)
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="service-item mb-5">
                                    {{-- <a href="{{ route('frontend_service', $v->seo_url) }}?category_type=parent&service_id={{ $v->id }}">--}}
                                    <a href="{{ route('frontend_zone_wise_service_single', [$zone, $parent_seo_url, $v->content_seo_url]) }}">
                                        <div class="service-box-wrap">
                                            <div class="service-box">
                                                <img
                                                    src="{{ $Query::accessModel('Media')::fullSize($v->content_image ?? NULL) }}"
                                                    alt="{!! $v->content_title ?? NULL !!}">
                                            </div>
                                        </div>
                                    </a>
                                    <div class="service-box-info section-service-box-info">
                                        <a href="{{ route('frontend_zone_wise_service_single', [$zone, $parent_seo_url, $v->content_seo_url]) }}">
                                            <h2>{!! $v->content_title ?? NULL !!}</h2>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @else
                    <div class="alert alert-light" style="border-left: 5px solid #c00;">
                        <strong>
                            Sorry, we are not providing any {{$term->name}} cleaning services in {{request()->zone}}.
                        </strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
