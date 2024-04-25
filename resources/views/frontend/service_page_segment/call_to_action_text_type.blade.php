@if(!empty($content->content_type) && $content->content_type == 'Special Text')
    {{--    <div class="section_gap py-0">--}}
    {{--        <div class="containerx">--}}
    {{--            <div class="row service special-content vertical-align">--}}
    {{--                <div class="col-md-8">--}}
    {{--                    <h3>{!! $content->content_title ?? NULL !!}</h3>--}}
    {{--                    {!! $content->content_details ?? NULL !!}--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4 text-center vertical-align">--}}
    {{--                    <a href="#" class="btn btn-white text-light-blue mt-3">Instant Online Quotes</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="section_gap py-0">

        <div class="container-fluid">
            <div class="annimated-counter-bg" style="padding: 28px 0px">
                <div class="row m-0 justify-content-center">
                    <div class="xcontainer col-lg-10">
                        <div class="row service zspecial-content vertical-align">
                            <div class="col-md-8 text-white">
                                <h3 class="text-white">
                                    {!! $content->content_title ?? NULL !!}
                                </h3>
                                {!! $content->content_details ?? NULL !!}
                            </div>
                            <div class="col-md-4 text-center vertical-align mt-3">
                                <a href="{{url('/booking_form')}}" class="btn bg_get_quote_btn"
                                   style="">
                                    Online Quote
                                </a>
                                <h5 class="text-white">
                                    <i class="fas fa-phone-alt"></i>
                                    <a class="text-white"
                                       href="tel:{{ get_global_setting('phone') }}">{{ get_global_setting('phone') }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
