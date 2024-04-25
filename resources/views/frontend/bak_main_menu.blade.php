<section id="themeheadersticky">
    <div class="header-main-menu">
        <nav class="navbar navbar-expand-lg top-navbar row m-0 justify-content-center">
            <div class="xcontainer menu-container-wrap col-lg-10">
                <!------------ HEADER LOGO ------------->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{ $Media::fullSize(get_global_setting('logo')) }}"
                             alt="{{ get_global_setting('meta_title') }}"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenuToggler"
                            aria-controls="headerMenuToggler" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse d-inline-block" id="headerMenuToggler">
                    @php
                        $primaryMenu = Menu::getByName('Primary Menu');
                    @endphp
                    <ul class="navbar-nav mr-auto">
                        @foreach($primaryMenu as $key => $value)
                            <li class="nav-item {{ (!empty($value['additional_file'])) ? 'dropdown' : '' }}">
                                @php
                                    if(Request::url() == url($value['link'])) {
                                        $active = ' active';
                                    } else if(!empty($value['additional_file']) && $value['additional_file'] == Request::segment(1)) {
                                        $active = ' active';
                                    } else {
                                        $active = NULL;
                                    }
                                @endphp

                                <a class="nav-link {{ $active ?? null }} {{ (!empty($value['additional_file'])) ? 'dropdown-toggle' : '' }}"
                                   href="{{ url($value['link']) }}"
                                   @if(!empty($value['additional_file']))
                                   id="navbarDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    @endif
                                >
                                    {{ $value['label'] }}
                                </a>
                                @if(!empty($value['additional_file']))
                                    @include('frontend.templates.menu.' . $value['additional_file'])
                                @endif
                            </li>
                        @endforeach
                    </ul>

                </div>


                <div class="menu-bar-search-form">
                    <a href="{{ route('frontend_booking_form') }}" class="btn btn-success">
                        Get a Quote
                    </a>
                </div>

                {{--                <div class="menu-bar-search-form">--}}
                {{--                    <form action="">--}}
                {{--                        <input type="text" placeholder="Search" />--}}
                {{--                        <div class="menu-bar-search-submit">--}}
                {{--                            <input type="submit" value="Submit" />--}}
                {{--                            <i class="fa fa-search"></i>--}}
                {{--                        </div>--}}
                {{--                    </form>--}}
                {{--                </div>--}}

            </div>
        </nav>
    </div>
</section>



