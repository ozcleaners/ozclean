@php
    $global_setting = $Query::accessModel('GlobalSetting')::first();
    //dd($global_setting);
@endphp
<footer>
    <div class="footer-widget">
        <div class="container-fluid">
            <div class="row m-0 justify-content-center">
                <div class="xcontainer col-xl-10 col-lg-12">
                    <div class="row">
                        <div class="footer-logo-wrap">
                            <a href="#" class="footer-logo">
                                <img class="img-responsive" src="{{ $global_setting->header_photo ?? NULL }}" alt=""/>
                            </a>
                        </div>
                        <!------------- WIDGET [ONE] -------------->
                        <div class="col-md-12 xfooter-widget-inline-wrapper row">
                            <div class="widget col-lg-3">
                                <h3 class="widget-title">&nbsp;<!----Title Text---></h3>
                                <div class="text-white">
                                    {{ $Query::frontendSettings('footer_about') }}
                                </div>
                            </div>
                            @php
                                $important_links = Menu::getByName('Important Links');
                            @endphp
                            <div class="widget col-lg-3">
                                <h3 class="widget-title"> Important Links </h3>
                                <div class="widget-list-items-with-anchor">
                                    <ul>
                                        @foreach($important_links as $key => $value)
                                            <li><a href="{{ $value['link'] }}">{{ $value['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            @php
                                $area_we_serve = Menu::getByName('Area we Serve');
                            @endphp
                            <div class="widget col-lg-3">
                                <h3 class="widget-title"> Area we Serve </h3>
                                <div class="widget-list-items-with-anchor">
                                    <ul>
                                        @foreach($area_we_serve as $key => $value)
                                            <li><a href="{{ $value['link'] }}">{{ $value['label'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="widget col-lg-3 socialIcons">
                                <h3 class="widget-title"> Connect with us on </h3>
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous"
                                        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=939424216758050&autoLogAppEvents=1"
                                        nonce="YV5myDZM"></script>

                                <div class="fb-page" data-href="{{ $Query::frontendSettings('facebook_url') }}"
                                     data-tabs="timeline" data-width="260" data-height="130" data-small-header="false"
                                     data-adapt-container-width="false" data-hide-cover="false"
                                     data-show-facepile="false">
                                    <blockquote cite="{{ $Query::frontendSettings('facebook_url') }}"
                                                class="fb-xfbml-parse-ignore">
                                        <a href="{{ $Query::frontendSettings('facebook_url') }}">Oz Cleaners</a>
                                    </blockquote>
                                </div>
                                {{--                                <a href="{{ $Query::frontendSettings('facebook_url') }}" class="fa fa-facebook"></a>--}}
                                <div class="mt-3">
                                    <a href="{{ $Query::frontendSettings('twitter_url') }}" class="fab fa-twitter"></a>
                                    <a href="{{ $Query::frontendSettings('youtube_url') }}" class="fab fa-youtube"></a>
                                    <a href="{{ $Query::frontendSettings('instagram_url') }}" class="fab fa-instagram"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copyright footer-copyright text-left row m-0 justify-content-center">
        <div class="xcontainer col-xl-10 col-lg-12">
            <div class="crow">
                <div class="copyright-text">
                    <p> 2023 © All rights reserved by Oz Cleaners</p>
                </div>
            </div>
        </div>
    </div>
</footer>


<a href="#" id="btn-back-to-top" class="scroll-top on d-none">
    <i class="fas fa-chevron-double-up"></i>
</a>


<section class="booking-mobile d-block d-lg-none">
    <article>
        <div class="phone">
            <a class="icon-phone" title="Click to call" href="tel:{{ $Query::globalSettings('phone') }}">
                <i class="fa fa-phone-alt"></i>
            </a>
        </div>

        <div class="book-now-mobile">
            <a href="{{ route('frontend_booking_form') }}">Online Quote</a>
        </div>

        <div class="social">
{{--            <a class="icon-phone" title="Click to call" href="{{ route('frontend_user_dashboard')}}">--}}
{{--                <i class="fa fa-user"></i>--}}
{{--            </a>--}}
        </div>
    </article>
</section>

@include('frontend.layouts.js')
