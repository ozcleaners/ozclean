@if(!empty($content->content_type) && $content->content_type == 'Vertical Tabs')
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
            @php
                $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->get();
            @endphp
            <div class="row bhoechie-tab-container">
                <div class="col-lg-2 bhoechie-tab-menu">
                    <div class="list-group">
                        @foreach($breakdown_contents as $k => $v)
                            <a href="javascript:void(0)"
                               class="list-group-item {{ $k == 0 ? 'active' : null }} text-center">
                                <img
                                    src="{!! $Media::fullSize($v->content_image)  !!}"
                                    alt="{!! $v->content_title ?? NULL !!}" style="width: 60px;"><br/>
                                {{ $v->content_title ?? NULL }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-10 bhoechie-tab" style="border-left: 1px solid #ddd;">
                    @foreach($breakdown_contents as $k => $v)
                        <div class="bhoechie-tab-content {{ $k == 0 ? 'active' : null }}">
                            {!! $v->content_details !!}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endif
