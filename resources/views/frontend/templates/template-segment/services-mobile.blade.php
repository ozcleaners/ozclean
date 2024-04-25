<ul class="xsubMobileMenu ">
    @php $m = 0; @endphp
    @foreach($zoneServices as $zone => $service)
        @php $m++; @endphp
        <li class="{{ $m == 1 ? 'xactive' : null }} dropdown">
            <a class="xnav__link dropdown-toggle targetMenu py-1"
               href="javascript:void(0)"
               data-target="#p{{$zone}}" data-toggle="dropdown" role="button" xaria-haspopup="true" xaria-expanded="false">
                <i class="material-icons">dashboard</i>
                {{$zone}} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="xsubMobileMenuSub dropdown-menu" id="p{{$zone}}">
                @php $k =0; @endphp
                @foreach ($service as $key => $parent)
                    @php $k++ @endphp
                    <li class="{{ $k == 1 ? 'xactive' : '' }} dropdown-submenu py-2">
                        <a href="javascript:void(0)" class="sublink"
                           id="p{{$zone}}"
                           data-target="#parent{{$key}}{{$parent['zone_lowercase_name']}}"
                           @if(count($parent['zone_wise_content_title']) > 0)
                           @else
                           onclick="ni(`{{ route('frontend_zone_wise_service_parent', [$parent['zone_lowercase_name'], $parent['seo_url']]) }}`)"
                           @endif
                           data-toggle="ta b">
                            <i class="fa fa-caret-right"></i>
                            {!! $parent['name'] !!}
                        </a>
                        @if(count($parent['zone_wise_content_title']) > 0)
                            <ul class="dropdown-menu pl-3">
                                <li class="{{ $k == 1 ? 'xactive' : '' }}"
                                    id="parent{{$key}}{{$parent['zone_lowercase_name']}}">
                                    @foreach ($parent['zone_wise_content_title'] as $index => $sub_services)
                                       <li>
                                           <a href="{{ route('frontend_zone_wise_service_single', [$parent['zone_lowercase_name'], $parent['seo_url'], $sub_services['content_seo_url']]) }}">
                                               <i class="fa fa-caret-right"></i>
                                               {!! $sub_services['content_title'] ?? null !!}
                                           </a>
                                       </li>
                                    @endforeach
                                </li>
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
@section('cusjs')
    <style>
        .subMobileMenu, .subMobileMenuSub {
            margin: 0;
            list-style: none;
            list-style-type: none;
        }

        .subMobileMenu {
            padding: 0;
            background: mintcream;
        }

        .subMobileMenuSub {
            background: lightyellow;
            padding-inline-start: 0 !important;
        }

        .subMobileMenuSub ul {
            margin: 0;
            padding: 5px 0;
            list-style: none;
            list-style-type: none;
        }

        .subMobileMenuSub li {
            margin: 0;
            padding: 0;
            list-style: none;
            list-style-type: none;
        }

        .subMobileMenuSub li > a {
            padding: 5px 15px;
        }

        .subMobileMenuSub li ul li {
            background: #f5f5f5;
            padding-inline-start: 15px;
        }

        .subMobileMenuSub li ul li > a {
            padding: 5px;
        }
    </style>
@endsection
