@if(!empty($content->content_type) && $content->content_type == 'Text Without Title')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    {!! $content->content_details ?? NULL !!}
                </div>
            </div>
        </div>
    </div>
@endif
