<div id="reload_me">
    <ul class="list-group" id="sortable">
        @php
            $contents = $Query::accessModel('TermCustomField')::where('content_term_id', request()->id)->where('content_zone', $zone)
                            ->where('content_for', 'Post')->orderBy('sorting_order', 'asc')->get();
            $termname = $Query::accessModel('Post')::where('id', request()->id)->first()->title;
        @endphp
        @if(count($contents) > 0)
            @foreach($contents as $key => $value)
                @php
                    $success = ' border-success border-top mt-1';
                @endphp

                <li style="cursor: move;"
                    class="list-group-item {{ $onValueId == $value->id ? $success : null }}"
                    id="item-{{ $value->id }}">

                    <span
                        class="position-absolute badge rounded-pill alert-info border border-light rounded-circle px-3"
                        style="top: -10px !important;">
                        {{ $value->content_type ?? NULL }}
                        <span class="visually-hidden">Content Type</span>
                    </span>
                    <div class="float-end">
                        {{--                        @dump($value->content_type)--}}
                        @if($value->content_type == 'Text' || $value->content_type == 'Term Title' || $value->content_type == 'Left Image Content' || $value->content_type == 'Right Image Content')
                        @else
                            <a class="d-inline-block alert-success py-0 px-2"
                               href="{{route('common_post_custom_field_breakdown_add', [request()->id]) }}?zone={{ $zone }}&custom_field_id={{ $value->id }}"
                            >
                                List of {{ $value->content_type }}
                            </a>
                        @endif
                        {!! $ButtonSet::delete('common_post_custom_field_destroy', $value->id) !!}
                        <a class="d-inline-block py-0"
                           href="{{ route('common_post_custom_field_edit', [request()->id]) }}?zone={{ $zone }}&section_id={{ $value->id }}">
                            <i class="icon-edit text-info"></i>
                        </a>
                    </div>


                    <span class="fw-bold">
                        {!! $value->content_title !!}
                    </span>
                    <br/>
                    <small class="text-secondary">
                        under <span class=" d-inline-block">{{ $termname }}</span>
                    </small>
                </li>
            @endforeach
        @else
            <li class="list-group-item">
                You have not created any list for this section yet.
            </li>
        @endif
    </ul>
</div>
