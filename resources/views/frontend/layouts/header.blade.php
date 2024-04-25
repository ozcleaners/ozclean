<!------------ TOP HEADER INFO ------------->
<div class="top-header-info row m-0 justify-content-center d-none" style="background: #fff; color: #333;">
    <div class="xcontainer col-lg-10">
        <div class="row top-header-info-item-wrap" style="border-bottom: 1px solid #ddd">
            <!------------ INFO ONE ------------->
            <div class="col-md-2 text-left top-header-info-item">
                <p>
                    {{--                    <img src="{{ $publicDir }}/frontend/img/th-icons/th1.png" alt=""/>--}}
                    <i class="fa fa-map-marked-alt"></i>
                    <span>{!! $Query::frontendSettings('location_of_service') !!}</span>
                </p>
            </div>
            <!------------ INFO TWO ------------->
            <div class="col-md-4 text-left top-header-info-item">
                <p class="top-nav-time">
                    {{--                    <img src="{{ $publicDir }}/frontend/img/th-icons/th2.png" alt=""/>--}}
                    <i class="fa fa-clock"></i>
                    <span>{{ $Query::frontendSettings('location_of_service_2nd') }}</span>
                </p>
            </div>
            <?php /*
                <!------------ INFO THREE ------------->
                <div class="col-md-2 text-left top-header-info-item">
                    <p class="top-nav-time">
                        <img src="{{ $publicDir }}/frontend/img/th-icons/th3.png" alt=""/>
                        <a href="#">Online Quote</a>
                    </p>
                </div>
                <!------------ INFO FOUR ------------->
                <div class="col-md-2 text-center top-header-info-item">
                    <p class="top-nav-time">
                        <img src="{{ $publicDir }}/frontend/img/th-icons/th4.png" alt=""/>
                        {{ $Query::globalSettings('phone') }}
                    </p>
                </div>
            */ ?>
                <!------------ INFO FIVE ------------->
            <!-- <div class="col-md-2 text-right top-header-info-item">
                <img src="{{ $publicDir }}/frontend/img/th-icons/th5.png" alt="" />
                <ul class="top-header-info-account">
                    <li><a href="">My Account</a>
                        @if(auth()->check())
                <ul>
                    <li><a href="">Profile</a></li>
                    <li>
                        <a href="{{ route('logout') }}" title="Logout"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                </form>
            </li>
        </ul>

            @else
                <ul>
                    <li><a href="Login">Login</a></li>
                    <li><a href="Login">Register</a></li>
                </ul>

            @endif
            </li>
        </ul>
    </div> -->
            <!------------ END INFO ------------->
        </div>
    </div>
</div>
<!------------ END TOP HEADER INFO ------------->


@include('frontend.main_menu')


{{--@php--}}
{{--    dump(Request::url());--}}
{{--    dump(Request::segment(1));--}}
{{--    dump(Request::segment(2));--}}
{{--    dump(Request::segment(3));--}}
{{--@endphp--}}
