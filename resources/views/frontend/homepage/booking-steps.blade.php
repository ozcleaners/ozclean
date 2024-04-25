<?php /*
<div class="section-background" style="background-color: #eaeaea;">
    <div class="row m-0 justify-content-center">
        <div class="xcontainer col-lg-10 pl-0">
            <div class="gradient_section_grey p-5">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="heading-4 text-center">Simple step of booking</h4>
                    </div>
                    <div class="step-of-process-wrap">
                        @php $bookingSteps = $Post::category($Query::frontendSettings('home_simple_step_of_booking'))->get() @endphp
                        @foreach ($bookingSteps  as $key => $post)
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="step-of-process">
                                    <div class="process-icon">
                                        <i aria-hidden="true" class="{{$post->font_awesome_icon}}"></i>
                                        <span class="process-number">{{++$key}}</span>
                                    </div>
                                    <div class="process-content">
                                        <h3 class="process-content-title"> {{$post->title}}</h3>
                                        <div
                                            class="process-content-description">{{$post->short_description}}</div>
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

*/ ?>

<div class="section-background" style="background-color: #eaeaea;">
    <div class="row m-0 justify-content-center">
        <div class="xcontainer col-xl-8 col-lg-11">
            <div class="row py-5">
                <div class="col-xl-4 col-lg-11">
                    <h4 class="heading-4 custom_heading-4 text-center text-xl-left">
                        Simple step of booking
                    </h4>
                </div>
                <div class="col-xl-8 col-lg-11 text-center text-xl-right">
                    @php
                        $bookingSteps = $Post::category($Query::frontendSettings('home_simple_step_of_booking'))->get();
                    @endphp
                    @foreach ($bookingSteps  as $key => $post)
                        @php
                            $color = [
                              '#8CBEB2',
                              '#F6B362',
                              '#F1605D',
                            ];
                            $checkOddEven = ($key % 2 ? 'Odd' : 'Even');
                        @endphp
                        <div class="c100 p100 big center <?php echo $checkOddEven == 'Odd' ? 'rotate' : null ?>"
                             style="margin-left: -24px; display:inline-flex">
                            <span>
                                <h6 style="color: #203647 !important;">
                                    {{$post->title}}
                                </h6>
                                <h6 style="color: #203647 !important;" class="desc">
                                    {{$post->short_description}}
                                </h6>
                            </span>
                            <div class="slice">
                                <div class="bar" style="border-color: {{$color[$key]}}"></div>
                                <div class="fill" style="border-color: {{$color[$key]}}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
