<nav class="navbar navbar-default navbar-fixed-top mobile_header_menu">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="float-right pt-3 text-dark" style="font-size: 19px;" title="Click to call" href="{{ route('frontend_user_dashboard')}}">
                <img src="{{ URL::asset('public/frontend/img/faq/my-account.png') }}" style="width: 25px;"/>
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mobileHeader">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{ $Media::fullSize(get_global_setting('logo')) }}"
                      alt="{{ get_global_setting('meta_title') }}"/>
            </a>
        </div>
        <div id="mobileHeader" class="navbar-collapse collapse">
            @php
                $primaryMenu = Menu::getByName('Primary Menu');
            @endphp
            <ul class="nav navbar-nav ">
                @foreach($primaryMenu as $key => $value)
                    @if(!empty($value['additional_file']))
                        @php
                            if(Request::url() == url($value['link'])) {
                                $active = ' active';
                            } else if(!empty($value['additional_file']) && $value['additional_file'] == Request::segment(1)) {
                                $active = ' active';
                            } else {
                                $active = NULL;
                            }
                        @endphp
                            <li id="parent-element" class="xnav-item {{ (!empty($value['additional_file'])) ? 'dropdown' : '' }}">

                                <a class="xnav-link {{ $active ?? null }} {{ (!empty($value['additional_file'])) ? 'dropdown-toggle' : '' }}"
                                   href="{{ url($value['link']) }}"
                                   @if(!empty($value['additional_file']))
                                       xid="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    @endif
                                >
                                    <i class="material-icons">dashboard</i>
                                    {{ $value['label'] }}
                                    <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="xsubMobileMenuSub dropdown-menu ml-3">
                                    @include('frontend.templates.menu.' . $value['additional_file'])
                                </ul>
                            </li>


                    @else
                        <li xclass="{{ '/'.request()->path() == $value['link'] ? 'active' : null }}">
                            <a
                               href="{{ url($value['link']) }}">
                                <i class="material-icons">dashboard</i>
                                {{ $value['label'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
{{--                <li class="active"><a href="#">Home</a></li>--}}
{{--                <li><a href="#">About</a></li>--}}
{{--                <li><a href="#">Contact</a></li>--}}
{{--                <li class="dropdown">--}}
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        <li><a href="#">Action</a></li>--}}
{{--                        <li><a href="#">Another action</a></li>--}}
{{--                        <li><a href="#">Something else here</a></li>--}}
{{--                        <li role="separator" class="divider"></li>--}}
{{--                        <li class="dropdown-header">Nav header</li>--}}
{{--                        <li><a href="#">Separated link</a></li>--}}
{{--                        <li><a href="#">One more separated link</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>


<style>
    .mobile_header_menu .dropdown-menu {
        border: none;
        background-color: #ffffff !important;
    }

    .mobile_header_menu ul {
        padding-inline-start: 0px;
        list-style: none;
    }
    .mobile_header_menu ul li a {
        position: relative;
        display: block;
        padding: 10px 15px;
        color: #000 !important;
        text-decoration: none;
    }
    .mobile_header_menu .dropdown-submenu {
        position: relative;
        padding: 10px 15px;
    }

    .mobile_header_menu .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>


<style>

</style>
