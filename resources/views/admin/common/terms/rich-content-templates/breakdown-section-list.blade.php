@php
    $zone = request()->get('zone');
    $contents = $Query::accessModel('TermCustomFieldBreakdown')::where('term_custom_field_id', request()->get('custom_field_id'))
                    ->orderBy('sorting_order', 'asc')->get();
    $termname = $Query::accessModel('Term')::where('id', request()->id)->first()->name;
@endphp

<div class="row mb-3">
    <div class="col-md-12 text-center">
        <a class="d-inline-block alert-success py-0 px-2"
           href="{{route('common_term_custom_field_breakdown_add', [request()->id]) }}?zone={{ $zone }}&custom_field_id={{ request()->get('custom_field_id') }}">
            Add New Item
        </a>

        <a class="d-inline-block alert-success py-0 px-2"
           href="{{ route('common_term_custom_field_edit', request()->id) }}?zone={{ $zone }}&section_id={{ request()->get('custom_field_id') }}">
            Back to section list
        </a>

    </div>
</div>
<div id="reload_me">
    <ul class="list-group" id="sortable">
        @if(count($contents) > 0)
            @foreach($contents as $key => $value)
                @php
                    $success = ' border-success border-top mt-1';
                @endphp

                <li style="cursor: move;"
                    class="list-group-item"
                    id="item-{{ $value->id }}">

                    <span
                        class="position-absolute badge rounded-pill alert-info border border-light rounded-circle px-3"
                        style="top: -10px !important;">
                        {{ $value->content_type ?? NULL }}
                        <span class="visually-hidden">Content Type</span>
                    </span>
                    <div class="float-end">
                        {!! $ButtonSet::delete('common_term_breakdown_destroy', $value->id) !!}

                        <a class="d-inline-block py-0"
                           href="{{ route('common_term_custom_field_breakdown_edit', [request()->id]) }}?zone={{ $zone }}&custom_field_id={{ request()->get('custom_field_id') }}&custom_field_breakdown_id={{ $value->id }} ">
                            <span class="icon-edit text-info"></span>
                        </a>
                    </div>
                    <div class="float-startx">
                        <div class="row">
                            <div class="col-md-2 px-0">
                                <img src="{{ $Media::iconSize($value->content_image) }}"
                                     class="img-fluid"
                                     style="width: 100px;"/>
                            </div>
                            <div class="col-md-10">
                                <span class="fw-bold">{!! $value->content_title ?? NULL !!}</span>
                                <small class="text-secondary">
                                    of {{ $Query::accessModel('TermCustomField')::where('id', request()->get('custom_field_id'))->first()->content_title }}
                                    under <span class=" d-inline-block">{{ $termname }}</span>
                                </small>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @else
            <li class="list-group-item">
                You have not created any section for this term yet.
            </li>
        @endif
    </ul>
</div>
