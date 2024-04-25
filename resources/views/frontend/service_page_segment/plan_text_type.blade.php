@if(!empty($content->content_type) && $content->content_type == 'Plan Text')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h2>{!! $content->content_title ?? NULL !!} </h2>
                    <h3>{!! $content->content_sub_title ?? NULL !!}</h3>
                    {!! $content->content_details ?? NULL !!}
                </div>
            </div>
        </div>
    </div>
@endif
