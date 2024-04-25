@extends('admin.layouts.master')
@section('title')
    Add/Edit Custom Field of Post
@endsection
{{--@section('filter')--}}
{{--    @if(request()->id)--}}
{{--        <a href="{{ route('common_term_edit', request()->id) }}" class="btn btn-sm btn-success py-0">Back</a>--}}
{{--    @endif--}}
{{--@endsection--}}

<?php
$zone = 8; //request()->get('zone');
$onValueId = request()->get('section_id') ?? null;
$zone_id = $Model('AttributeValue')::where('unique_name', 'zone')->where('value', $zone)->first()->id ?? null;
?>

@section('content')
    @if(!empty(request()->id))
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 py-2 text-center">

                </div>
            </div>
            <div class="row">
                <div class="col-md-8 py-2 text-center">
                    <a href="{{ route('common_post_custom_field_edit', request()->id ) }}?zone={{ $zone }}"
                       class="btn btn-sm {{ request()->routeIs('common_post_custom_field_edit', request()->id) ? ' btn-success' : ' btn-outline-secondary' }} py-0">
                        <i class="fa fa-plus"></i> Add new section
                        of {{ $Query::accessModel('Post')::where('id', request()->id)->first()->title }}
                    </a>
                </div>
                {{--                <div class="col-md-12 py-2 text-center">--}}
                {{--                    @php--}}
                {{--                        $zones = $Query::accessModel('AttributeValue')::where('unique_name', 'Zone')->get();--}}
                {{--                    @endphp--}}
                {{--                    @foreach($zones as $key => $val)--}}
                {{--                        <a class="position-relative btn btn-sm {{ (request()->get('zone') == $val->value) ? ' btn-warning' : 'alert-primary' }}"--}}
                {{--                           href="{{ route('common_term_custom_field_edit', request()->id) }}?zone={{ $val->value }}">--}}
                {{--                            {{ $val->value }}--}}
                {{--                            <span--}}
                {{--                                class="position-absolute top-0 start-50 translate-middle badge rounded-pill alert-success border border-light rounded-circle">--}}
                {{--                                {{ $Query::accessModel('TermCustomField')::where('content_zone', $val->value)->where('content_term_id', request()->id)->count() }}--}}
                {{--                                <span class="visually-hidden">Total Sections</span>--}}
                {{--                            </span>--}}
                {{--                        </a>--}}
                {{--                    @endforeach--}}
                {{--                </div>--}}
                {{--                <div class="col-md-12 py-2">--}}
                {{--                    <div class="text-center mb-2">--}}

                {{--                        <a href="{{ route('common_term_custom_field_edit', request()->id ) }}?zone={{ $zone }}"--}}
                {{--                           class="btn btn-sm {{ request()->routeIs('common_term_custom_field_edit', request()->id) ? ' btn-success' : ' btn-outline-secondary' }} py-0">--}}
                {{--                            <i class="fa fa-plus"></i> Add new section--}}
                {{--                            of {{ $Query::accessModel('Term')::where('id', request()->id)->first()->name }}--}}
                {{--                            under {{ $zone }}--}}
                {{--                        </a>--}}

                {{--                        <a href="{{ route('common_term_custom_field_seo', request()->id) }}?zone={{ $zone }}"--}}
                {{--                           class="btn btn-sm {{ request()->routeIs('common_term_custom_field_seo', request()->id) ? ' btn-success' : ' btn-outline-secondary' }} py-0">--}}
                {{--                            <i class="fa fa-plus"></i> SEO Information--}}
                {{--                            of {{ $Query::accessModel('Term')::where('id', request()->id)->first()->name }}--}}
                {{--                            under {{ $zone }}--}}
                {{--                        </a>--}}

                {{--                        <a class="btn btn-sm  py-0 {{ request()->routeIs('common_term_postcode_rate', request()->id) ? ' btn-success' : ' btn-outline-secondary' }}"--}}
                {{--                           href="{{route('common_term_postcode_rate', request()->id)}}?zone={{ $zone }}">--}}
                {{--                            Postcode Rate--}}
                {{--                        </a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <hr/>
            {{--            @if(!empty(request()->zone))--}}
            <div class="row">
                <div class="col-md-6">
                    @if(request()->routeIs('common_post_custom_field_edit', request()->id))
                        @include('admin.common.posts.rich-content-templates.section-create-form')
                    @endif
                </div>
                <div class="col-md-6" style="font-size: 10px;">
                    @include('admin.common.posts.rich-content-templates.section-list')
                </div>
            </div>
            {{--            @else--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-md-12 text-center">--}}
            {{--                        Please select a zone to add or edit content.--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endif--}}
        </div>
    @endif
@endsection

@section('cusjs')
    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();
            $('#sortable').sortable({
                axis: 'y',
                cursor: 'move',
                update: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    // alert('nipun');
                    // POST to server using $.post or $.ajax
                    //console.log(data);
                    // pageReloadSpinner();
                    $.ajax({
                        data: data,
                        type: 'POST',
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        url: "{{ route('common_term_custom_fields_sorting') }}?id={{ request()->id }}",

                        success: function (output) {
                            //alert(output.message);
                            toastr.success(output.message);
                            jQuery(window).load(function () {

                                $("div#reload_me").load(window.location.assign(href) + " div#reload_me");
                                //location.reload();
                            });
                            //alert(234028309);
                            //
                            //$("#sortable").sortable("refresh");
                            //ad();
                        }
                    });

                    // admin/common/term/edit/34?which_editor=term_custom_field
                }
            });

            $('#content_title').blur(function () {
                var m = $(this).val();
                var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
                var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

                $('#content_seo_url').val(cute);
            });

        });
    </script>
    <style>
        .list-group-item {
            padding: 1rem 1rem;
        }
    </style>
@endsection
