@if(!empty($content->content_type) && $content->content_type == 'Why Choose Us')
    <div class="section_gap  row m-0 justify-content-center"
         style="background-color: {{ $content->bg_color ?? NULL }}; padding-bottom: 40px;">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="service_section_title text-center">
                        {!! $content->content_title ?? NULL !!}
                    </h4>
                    <div class="row service_list_group box-shadow">

                        @php
                            $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->where('content_type', 'Normal List')->get()->toArray();
                            $breakdown_counter = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->where('content_type', 'Counter')->get()->toArray();
                            $first = array_slice($breakdown_contents, 0, 3);
                            $second = array_slice($breakdown_contents, 3, 5);
                        @endphp


                        <div class="why-choose-us-for-desktop">
                            <div class="col-md-3-5 col-sm-4 col-xs-12">
                                @foreach($first as $key => $data)
                                    <div class="animated-service-box">
                                        <div class="animated-service-icon">
                                            <i aria-hidden="true" class="{{ $data['font_awesome'] ?? NULL }}"></i>
                                        </div>
                                        <div class="animated-service-content">
                                            <h3 class="animated-service-title">
                                                {!! $data['content_title'] ?? NULL  !!}
                                            </h3>
                                            <div class="animated-service-description">
                                                {!! $data['content_details'] ?? NULL  !!}
                                            </div>
                                            <span class="animated-service-link" href="#">
                                                <i class="fa fa-long-arrow-right"></i>
                                            </span>
                                        </div>
                                    </div>
                            @endforeach
                            <!----- END SERVICE ------>
                            </div>
                            <div class="col-md-4-5 col-sm-4 col-xs-12 desktop-top-padding">
                                <!----- SINGLE BANNER ------>
                                <div class="row-spacer-short"></div>

                                <div class="single-banner">
                                    <div class="single-banner-inner">
                                        <!----- BANNER IMAGE ------>
                                        <img src="{{ $Media::fullSize($content->content_image ?? NULL) }}"
                                             class="img-responsive"
                                             alt="{!! $breakdown_counter[0]['content_title'] ?? NULL  !!} ">
                                        <div class="single-banner-content">
                                            <div class="single-banner-content-meta">
                                                <div class="single-banner-content-heading">
                                                    {!! $breakdown_counter[0]['content_title'] ?? NULL  !!}
                                                </div>
                                                <h4 class="single-banner-content-info">
                                                    {!! $breakdown_counter[0]['content_sub_title'] ?? NULL  !!}
                                                </h4>
                                            </div>
                                            <svg class="single-banner-content-bg" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 123 112">
                                                <path
                                                    d="M22.46,0.262a673.892,673.892,0,0,1,80.844,6.4c10.079,0.592,18.735,9.565,19.027,19.5,0.3,10.95.4,40.706,0.279,51.6-0.133,9.926-8.631,18.351-18.682,18.816-27.125,3.568-54.074,7.216-81.04,8.5-10.037-.5-18.485-9.1-18.424-18.875,0.077-15.525.671-50.13,0.527-66.126C4.9,9.975,12.466.983,22.46,0.262h0Z"></path>
                                            </svg>
                                            <svg class="single-banner-content-overlay-bg"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 123 112">
                                                <path
                                                    d="M22.46,0.262a673.892,673.892,0,0,1,80.844,6.4c10.079,0.592,18.735,9.565,19.027,19.5,0.3,10.95.4,40.706,0.279,51.6-0.133,9.926-8.631,18.351-18.682,18.816-27.125,3.568-54.074,7.216-81.04,8.5-10.037-.5-18.485-9.1-18.424-18.875,0.077-15.525.671-50.13,0.527-66.126C4.9,9.975,12.466.983,22.46,0.262h0Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mobile-bottom-spacer">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="small-counter-with-icon-wrap">
                                            <div class="small-counter-with-icon-inner">
                                                <div class="small-counter-with-icon-item-icon">
                                                    <i aria-hidden="true"
                                                       class="{{ $breakdown_counter[1]['font_awesome'] ?? NULL }}"></i>
                                                </div>
                                                <div class="small-counter-with-icon-holder">
                                                    <div class="small-counter-number">
                                                        <span
                                                            class="small-counter-number-value single-counter-number-value">
                                                            {{ $breakdown_counter[1]['content_title'] ?? NULL }}
                                                        </span>
                                                        <span class="small-counter-number-suffix fw-bolder"
                                                              style="font-weight: bold; font-size: 22px;">+</span>
                                                    </div>
                                                    <div class="small-counter-title">
                                                        {{ $breakdown_counter[1]['content_sub_title'] ?? NULL }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="small-counter-with-icon-wrap">
                                            <div class="small-counter-with-icon-inner">
                                                <div class="small-counter-with-icon-item-icon">
                                                    <i aria-hidden="true"
                                                       class="{{ $breakdown_counter[2]['font_awesome'] ?? NULL }}"></i>
                                                </div>
                                                <div class="small-counter-with-icon-holder">
                                                    <div class="small-counter-number">
                                                <span class="small-counter-number-value single-counter-number-value">
                                                    {{ $breakdown_counter[2]['content_title'] ?? NULL }}
                                                </span>
                                                        <span class="small-counter-number-suffix"
                                                              style="font-weight: bold; font-size: 22px;">+</span>
                                                    </div>
                                                    <div class="small-counter-title">
                                                        {{ $breakdown_counter[2]['content_sub_title'] ?? NULL }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3-5 col-sm-4 col-xs-12">
                                <!----- SERVICE BOX ------>
                                @foreach($second as $key => $data)
                                    <div class="animated-service-box">
                                        <div class="animated-service-icon">
                                            <i aria-hidden="true" class="{{ $data['font_awesome'] ?? NULL }}"></i>
                                        </div>
                                        <div class="animated-service-content">
                                            <h3 class="animated-service-title">
                                                {{ $data['content_title'] ?? NULL }}
                                            </h3>
                                            <div class="animated-service-description">
                                                {!! $data['content_details'] ?? NULL  !!}
                                            </div>
                                            <span class="animated-service-link" href="#">
                                                <i class="fa fa-long-arrow-right"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
