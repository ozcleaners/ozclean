@php
    $partners = get_frontend_setting('partners', true);
@endphp
<div class="section-background" style="background:#eee9e9">
    <div class="row m-0 justify-content-center">
        <div class="xcontainer col-lg-10" id="hide-from-mobile-tab">
            <div class="row">

                <div class="col-md-6">
                    <!----- SINGLE COUNTER ------>
                    <div class="single-counter ">
                        <div class="single-counter-inner">
                            <div class="single-counter-content">
                                <div class="single-counter-icon"></div>
                                <div class="single-counter-number">
                                    <span class="single-counter-number-prefix"></span>
                                    <span class="single-counter-number-value" data-duration="2000"
                                          data-to-value="80"
                                          data-delimiter=",">{{ $partners['meta_value'][0] }}</span>
                                    <span class="single-counter-number-suffix">+</span>
                                </div>
                            </div>
                            <h4 class="single-counter-title">{{ $partners['meta_value'][1] }}</h4>
                        </div>
                    </div>
                    <!----- END SINGLE COUNTER ------>
                </div>


                <div class="col-md-6">
                    <!----- CLIENT LOGO ------>
                    <div class="clients-logo-grid">
                        <div class="clients-logo-inner">
                            <!----- LOGO ONE ------>
                            @foreach($partners['meta_value'] as $key => $value)
                                @php
                                    $dt = explode('-', $value)
                                @endphp
                                @if($key != 0 && $key !== 1)

                                    @if($key != 3 && $key != 6)
                                        @php
                                            $right_border = ' right-border';
                                        @endphp
                                    @endif


                                    @if($key <= 4)
                                        @php
                                            $bottom_border = ' bottom-border';
                                        @endphp
                                    @else
                                        @php
                                            $bottom_border = ' ';
                                        @endphp
                                    @endif

                                    <div class="grid-item {{ $bottom_border }} {{ $right_border }}">
                                        <div class="client-image">
                                            <a href="javascript:void(0)">
                                                <img src="{{ $Media::fullSize($dt[0]) }}"
                                                     class="img-responsive attachment-full" alt="{{ $dt[1] }}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

