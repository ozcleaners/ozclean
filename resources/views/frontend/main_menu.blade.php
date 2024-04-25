<section id="themeheadersticky">
    <nav class="navbar navbar-default navbar-fixed-top row m-0 justify-content-center header-main-menu px-0 py-2">
        <div class="xcontainer col-xl-10 col-lg-11" style="padding-left: 0px !important;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand px-0" href="{{url('/')}}">
                    <img src="{{ $Media::fullSize(get_global_setting('logo')) }}"
                         alt="{{ get_global_setting('meta_title') }}"/>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div id="headerMenuToggler">
                    @php
                        $primaryMenu = Menu::getByName('Primary Menu');
                    @endphp
                    <ul class="navbar-nav">
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

                    <div class="navbar-form xnavbar-right mb-0 mt-2 float-xl-right text-lg-center">
                        <div class="d-inline-block header_phone_number my_account" style="">
                            <a href="{{route('frontend_user_dashboard')}}">
                                {{--                                <i class="fa fa-user mx-2"></i>--}}
                                <img src="{{ URL::asset('public/frontend/img/faq/my-account.png') }}" style="width: 25px;" alt="my-account"/>
                                {{auth()->check() ? 'My Account' : 'Login'}}
                            </a>
                        </div>
                        <div class="d-inline-block header_phone_number" style="">
                            {{--                            <i class="fa fa-phone-alt mx-2"></i>--}}
                            <img src="{{ URL::asset('public/frontend/img/faq/phone-icon.png') }}" style="width: 25px;" alt="phone"/>
                            {{ $Query::globalSettings('phone') }}
                        </div>
                        <div class="d-inline-block">
                            <a href="{{ route('frontend_booking_form') }}" class="btn bg_get_quote_btn">
                                Online Quote
                            </a>
                        </div>
                    </div>
                </div>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
</section>


<style>
    .my_account, .my_account a {
        font-size: 16px;
        font-weight: 400;
        color: #333;
    }

    .my_account a:hover {
        text-decoration: none;
        color: #0a53be;
    }
</style>
