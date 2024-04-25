@if(!empty($content->content_type) && $content->content_type == 'Right Image Content Without Title')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-7">
{{--                    <h4 class="term_page_heading">{!! $content->content_title ?? NULL !!}</h4>--}}
{{--                    <h6 class="term_page_sub_heading">{!! $content->content_sub_title ?? NULL !!}</h6>--}}
                    {!! $content->content_details ?? NULL !!}

                </div>
                <div class="col-md-5">

                    <img src="{{ $Media::fullSize($content->content_image) }}"
                         alt="{{ $content->content_title ?? NULL }}">

                </div>
            </div>
        </div>
    </div>
@endif
