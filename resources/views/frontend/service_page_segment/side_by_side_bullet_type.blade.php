@if(!empty($content->content_type) && $content->content_type == 'Side by Side Bullets')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        {!! $content->content_title !!}
                    </h4>
                    {!! $content->content_details ?? NULL !!}
                </div>
            </div>
            <div class="row p0">
                @php
                    $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->orderBy('sorting_order', 'asc')->get();
                @endphp
                @foreach($breakdown_contents as $k => $v)
                    <div class="col-md-3">
                        <div class="side_by_side_bullets">
                            <div class="my-5">
                                <img src="{{ $Media::fullSize($v->content_image) }}"
                                     alt="{{ $v->content_title ?? NULL }}">
                            </div>
                            <h1 style="font-size: 20px; margin: 15px 0 0 0; color: rgb(0, 46, 64);">{!! $v->content_title ?? NULL  !!}</h1>
                            {!! $v->content_details !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
