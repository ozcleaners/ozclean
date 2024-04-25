<div class="section-background">
    <div class="row m-0 justify-content-center">
        <div class="xcontainer col-xl-10 col-lg-11 pl-0 pr-0 pr-lg-4">
            <div class="gradient_section_grey p-5">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-5 text-center text-lg-left">
                        <h4>Services we provide</h4>
                        <p>
                            {{ $Model('Term')::where('id', 3)->first()->term_short_description ?? NULL }}
                        </p>

                        <a href="{{ route('frontend_booking_form') }}" class="btn get_quote_btn vice_verca">
                            Get a Quote
                        </a>
                    </div>
                    <div class="col-xl-5 col-lg-7 custom_service_design">
                        <div class="row">
                            @php
                                $services = App\Models\Term::where('parent', 3)->get();
                                $i = 1;
                            @endphp
                            @foreach ($services as $key => $v)
                                <div class="col-lg-6 col-6 pt-3 py-2 py-lg-4">
                                    <a href="{{ route('frontend_zone_wise_service_parent', ['adelaide', $v->seo_url]) }}">
                                    <div class="card card-body block block_{{ ++$key }}  h-100">
                                        {{ $v->name }}
                                    </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>


                        <div class="row col-container d-none">
                            @php
                                $services = App\Models\Term::where('parent', 3)->get();
                                $i = 1;
                            @endphp
                            @foreach ($services as $key => $v)
                                @if($v)
                                    <div class="col-lg-6 my-3 ">
                                        <a href="{{ route('frontend_zone_wise_service_parent', ['adelaide', $v->seo_url]) }}">
                                            <div class="block block_{{ $i }} cols">
                                                {{ '0' . $i }} {{ $v->name }}
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="section-background" style="background-color: #f9f9f9;padding-bottom: 50px;">--}}
{{--    <div class="row m-0 justify-content-center">--}}
{{--        <div class="xcontainer col-lg-10">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <h4 class="heading-4 text-center">Services we provide</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                @php--}}
{{--                    $services = App\Models\Term::where('parent', 3)->get();--}}
{{--                @endphp--}}
{{--                @foreach ($services as $key => $v)--}}
{{--                    @if($v)--}}
{{--                        <div class="col-md-3 col-sm-6 col-xs-6">--}}
{{--                            <div class="service-item">--}}
{{--                                --}}{{--                                    <a href="{{ route('frontend_service', $v->seo_url) }}?category_type=parent&service_id={{ $v->id }}">--}}
{{--                                <div class="service-box-wrap">--}}
{{--                                    <a href="{{ route('frontend_zone_wise_service_parent', ['adelaide', $v->seo_url]) }}">--}}
{{--                                        <div class="service-box">--}}
{{--                                            <img--}}
{{--                                                src="{{ $Query::accessModel('Media')::fullSize($v->thumb_image) }}"--}}
{{--                                                alt="{{ $v->name }}">--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="service-box-info section-service-box-info">--}}
{{--                                    <h2>--}}
{{--                                        <a href="{{ route('frontend_zone_wise_service_parent', ['adelaide', $v->seo_url]) }}">{{ $v->name }}</a>--}}
{{--                                    </h2>--}}
{{--                                    @php--}}
{{--                                        $zones = $Model('AttributeValue')::where('unique_name', 'Zone')->get();--}}
{{--                                    @endphp--}}
{{--                                    @foreach($zones as $k => $zone)--}}
{{--                                        <a href="{{ route('frontend_zone_wise_service_parent', [$zone->slug, $v->seo_url]) }}"--}}
{{--                                           class="btn btn-sm btn-default px-1 py-0  d-none"--}}
{{--                                           style="border-radius: 15% 0;" title="{{ $zone->value ?? NULL }}">--}}
{{--                                            {{ substr($zone->value, 0, 2)  }}--}}
{{--                                        </a>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




