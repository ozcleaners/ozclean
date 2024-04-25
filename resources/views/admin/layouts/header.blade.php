<header class="header-wrapper">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light py-0">
        <div class="container-fluid">
            <div class="menu-item">
                <a class="navbar-brand" href="{{ route('admin_dashboard') }}">
                    <i class="icon-hexagon"></i>
                </a>
                {{--                <ul class="sub-menu" id="toggleClass">--}}
                {{--                    <li>--}}
                {{--                        <a href="javascript:void(0)">About this mac</a>--}}
                {{--                    </li>--}}
                {{--                    <li>--}}
                {{--                        <a href="javascript:void(0)">menu 1</a>--}}
                {{--                        <i class="fas fa-caret-right"></i>--}}
                {{--                        <ul class="sub-menu ">--}}
                {{--                            <li>--}}
                {{--                                <a href="javascript:void(0)">--}}
                {{--                                    menu 4--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                            <li>--}}
                {{--                                <a href="javascript:void(0)">--}}
                {{--                                    menu 5--}}
                {{--                                </a>--}}
                {{--                            </li>--}}
                {{--                        </ul>--}}
                {{--                    </li>--}}
                {{--                    <li>--}}
                {{--                        <a href="javascript:void(0)">menu 1</a>--}}
                {{--                    </li>--}}
                {{--                </ul>--}}
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>

            @include('admin.layouts.nav-menu.top-left-menu')

            <div class="header-right_site">
                <div class="header-spl-icon">
                    <ul>
                        <li>
                            <a href="{{route('upload_routelist')}}" title="Reload Routelist">
                                <i class="fas fa-sync"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/')}}" target="_blank" title="Website">
                                <i class="fas fa-globe"></i>
                            </a>
                        </li>
                        {{--                        <li>--}}
                        {{--                            <a href="javascript:void(0)">--}}
                        {{--                                <i class="fas fa-wifi"></i>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li>--}}
                        {{--                            <a href="javascript:void(0)">--}}
                        {{--                                <i class="fas fa-search"></i>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li>--}}
                        {{--                            <a href="javascript:void(0)">--}}
                        {{--                                <i class="fas fa-battery-full"></i>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="menu-item">--}}
                        {{--                            <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">--}}
                        {{--                                <i class="far fa-user"></i>--}}
                        {{--                            </a>--}}
                        {{--                            <ul class="sub-menu dropdown-menu">--}}
                        {{--                                <li>--}}
                        {{--                                    <a href="javascript:void(0)">menu 1</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li>--}}
                        {{--                                    <a href="javascript:void(0)">menu 1</a>--}}

                        {{--                                </li>--}}
                        {{--                                <li>--}}
                        {{--                                    <a href="javascript:void(0)">menu 1</a>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </li>--}}
                        <li class="date_info">
                            <span>{{auth()->user()->name}}</span>
                        </li>
                        <li class="date_info">
                            <span>
                                <a class="nav-link" href="{{ route('logout') }}" title="Logout"
                                   onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
