@if(!empty($content->content_type) && $content->content_type == 'Text')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="blog-img">
                        <img
                            src="{!! $Media::fullSize($content->content_image) !!}"
                            alt="{!! $content->content_title ?? NULL !!}">
                    </div>
                </div>
                <div class="col-md-6 bullets_point">
                    <h2>{!! $content->content_title ?? NULL !!} </h2>
                    <h3>{!! $content->content_sub_title ?? NULL !!}</h3>
                    {!! $content->content_details ?? NULL !!}
                </div>
            </div>
        </div>
    </div>
@endif