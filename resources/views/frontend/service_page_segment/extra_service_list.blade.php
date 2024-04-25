@if(!empty($content->content_type) && $content->content_type == 'Extras')
    <div class="section_gap  row m-0 justify-content-center">
        <div class="xcontainer col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="service_section_title text-center">
                        {!! $content->content_title ?? NULL !!}
                    </h4>
                </div>
            </div>
            @php
                $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->orderBy('sorting_order', 'asc')->get();
            @endphp

            @foreach($breakdown_contents as $key => $content)
                @if($content->content_type == 'Left Image List Type')
                    <div class="row subsection_gap d-lg-flex">
                        <div class="col-md-2 text-center">
                            <img class="w-100 img-fluid" src="{{ $Media::fullSize($content->content_image) }}"
                                 alt="{{ $content->content_title ?? NULL }}">
                        </div>
                        <div class="col-md-10">
                            <h5 class="service_subsection_title">{{ $content->content_title ?? NULL }}</h5>
                            {!! $content->content_details ?? NULL !!}
                        </div>
                    </div>
                @elseif($content->content_type == 'Right Image List Type')
                    <div class="row subsection_gap d-lg-flex">
                        <div class="col-md-10">
                            <h5 class="service_subsection_title">{{ $content->content_title ?? NULL }}</h5>
                            {!! $content->content_details ?? NULL !!}
                        </div>
                        <div class="col-md-2 text-center">
                            <img class="w-100 img-fluid" src="{{ $Media::fullSize($content->content_image) }}"
                                 alt="{{ $content->content_title ?? NULL }}">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
