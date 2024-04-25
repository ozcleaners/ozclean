@if(!empty($content->content_type) && $content->content_type == 'Before After')
    <div class="section_gap" style="background-color: {{ $content->bg_color ?? NULL }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="service_section_title text-center">
                        {!! $content->content_title !!}
                    </h4>
                    <p style="margin: 0; padding: 0;">
                        {!! $content->content_sub_title ?? NULL !!}
                    </p>
                </div>
            </div>
            <div class="row">
                @php
                    $breakdown_contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', $content->id)->orderBy('sorting_order', 'asc')->limit(6)->get();
                @endphp
                <div class="col-md-12 before_after">
                    <div class="gallery image-set">
                        @foreach($breakdown_contents as $k => $v)
                            <figure class="{{$k == 0 ? 'd-block' : 'd-none d-lg-block'}} col-lg-4">
                                <a class="example-image-link" href="{{ $Media::fullSize($v->content_image) }}"
                                   data-lightbox="example-set"
                                   data-title="{{ $v->content_title ?? NULL }}">
                                    <img
                                        src="{{ $Media::fullSize($v->content_image) }}"
                                        alt="{{ $v->content_title ?? NULL }}"/>
                                    <figcaption>{{ $v->content_title ?? NULL }}</figcaption>
                                </a>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



