@if(!empty($content->content_type) && $content->content_type == 'Multiple Image')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">
                        {!! $content->content_title !!}
                    </h4>
                    <p style="margin: 0; padding: 0;">
                        {!! $content->content_sub_title ?? NULL !!}
                    </p>
                </div>
            </div>
            <div class="row p40">
                @php
                    $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->get();
                @endphp
                @foreach($breakdown_contents as $k => $v)
                    <div class="col-md-4" style="margin-bottom: 15px;">
                        <div class="blog-img">
                            <img src="{{ $Media::fullSize($content->content_image) }}"
                                 alt="{{ $content->content_title ?? NULL }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
