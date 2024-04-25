@php
    $services = App\Models\Term::where('parent', 3)->get();
    $zoneServices = \App\Models\Term::serviceCat();
//    dd($zoneServices);
@endphp
<div class="d-none d-lg-block">

    <div class="dropdown-menu serviceNavs row m-0 justify-content-center" aria-labelledby="navbarDropdown">
        <div class="xcontainer xd-block col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="service_menu_tab with-nav-tabs text-center">
                        <div class="zoneTabs">
                            <ul class="nav nav-tabs mx-auto d-inline-flex">
                                @php $m = 0; @endphp
                                @foreach($zoneServices as $zone => $service)
                                    @php $m++; @endphp
                                    <li class="btn zoneArea btn-sm {{ $m == 1 ? 'active' : null }}">
                                        <a href="#tab{{$zone}}" data-toggle="tab">
                                            {{$zone}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @php $i = 0; @endphp
                            @foreach($zoneServices as $zone => $service)
                                @php $i++; @endphp
                                <div class="tab-pane fade in {{ $i == 1 ? 'active' : null }}" id="tab{{$zone}}">
                                    <div class="row equal">
                                        <div class="col-md-2">
                                            <!-- required for floating -->
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs tabs-left d-block navMainTerms">
                                                @php $k =0; @endphp
                                                @foreach ($service as $key => $parent)
                                                    @php $k++ @endphp
                                                    <li class="{{ $k == 1 ? 'active' : '' }} {{ ($parent['seo_url'] == Request::segment(3)) ? 'subParentActive' : null }}">
                                                        <a href="javascript:void(0)"
                                                           data-target="#parent{{$key}}{{$parent['zone_lowercase_name']}}"
                                                           onclick="ni(`{{ route('frontend_zone_wise_service_parent', [$parent['zone_lowercase_name'], $parent['seo_url']]) }}`)"
                                                           data-toggle="tab">
                                                            {{ $parent['name'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-10">
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                @php
                                                    $k = 0;
                                                    //dump($service);
                                                @endphp
                                                @foreach($service as $key => $parent)
                                                    @php $k++ @endphp
                                                    <div class="tab-pane {{ $k == 1 ? 'active' : '' }}"
                                                         id="parent{{$key}}{{$parent['zone_lowercase_name']}}">

                                                        @foreach ($parent['zone_wise_content_title'] as $index => $sub_services)

                                                            @php
                                                                $checkActive = $Model('TermZoneOtherSetting')::getValue($sub_services['content_term_id'],$parent['zone_id'], 'zone_content_is_active') ?? null;
                                                            @endphp
                                                            @if($checkActive != 'No')
                                                            <div class="col-lg-2 col-md-3 col-sm-3 no-margin-padding mb-4">
                                                                @php
                                                                    $pageUrl = route('frontend_zone_wise_service_single', [$parent['zone_lowercase_name'], $parent['seo_url'], $sub_services['content_seo_url']]);
                                                                    if($pageUrl == Request::url()) {
                                                                        $active = ' active';
                                                                    } else {
                                                                        $active = null;
                                                                    }

                                                                @endphp
                                                                <div class="service-item mb-4 {{ $active }}">
                                                                    <a href="{{ route('frontend_zone_wise_service_single', [$parent['zone_lowercase_name'], $parent['seo_url'], $sub_services['content_seo_url']]) }}">
                                                                        <div class="service-box-wrap">
                                                                            <div class="service-box">
                                                                                <img
                                                                                    src="{{ $Media::fullSize($sub_services['content_image']) }}"
                                                                                    alt="{{ $sub_services['content_title'] }}">
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="service-box-info">
                                                                        <a href="{{ route('frontend_zone_wise_service_single', [$parent['zone_lowercase_name'], $parent['seo_url'], $sub_services['content_seo_url']]) }}">
                                                                            <h2>{!! $sub_services['content_title'] ?? null !!} </h2>

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-block d-lg-none">
    @include('frontend.templates.template-segment.services-mobile')
</div>
