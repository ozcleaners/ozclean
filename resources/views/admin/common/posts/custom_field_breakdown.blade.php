@extends('admin.layouts.master')

@section('title')
    Custom Field Breakdown of
    {{ $Query::accessModel('TermCustomField')::where('id', request()->get('custom_field_id'))->first()->content_title }} under
    {{ $Query::accessModel('Term')::where('id', request()->id)->first()->name }}
@endsection

@section('filter')
    @if(request()->id)
        <a href="{{ route('common_post_custom_field_edit', request()->id) }}?zone={{ request()->get('zone') }}&section_id={{ request()->get('custom_field_id') }}"
           class="btn btn-sm btn-success py-0">
            Back
        </a>
    @endif
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6">
                @include('admin.common.posts.rich-content-templates.breakdown-create-form')
            </div>
            <div class="col-md-6" style="font-size: 10px;">
                @include('admin.common.posts.rich-content-templates.breakdown-section-list')
            </div>
        </div>
    </div>
@endsection


@section('cusjs')
    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();
            reloadable();
            $('#content_title').blur(function () {
                var m = $(this).val();
                var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
                var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

                $('#content_seo_url').val(cute);
            });

        });

        function reloadable() {
            jQuery('#sortable').sortable({
                axis: 'y',
                cursor: 'move',
                // items: 'li',
                // containment: '#reload_me',
                // forceHelperSize: true,
                // forcePlaceHolderSize: true,
                // start: function (e, ui) {
                //     ui.item.addClass('ui-state-highlight');
                // },
                // stop: function (e, ui) {
                //     ui.item.removeClass('ui-state-highlight');
                // },
                update: function (event, ui) {
                    var data = jQuery(this).sortable('serialize');

                    //pageReloadSpinner();
                    jQuery.ajax({
                        data: data,
                        type: 'POST',
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        url: "{{ route('common_post_custom_fields_breakdown_sorting') }}?id={{ request()->get('custom_field_id') }}",

                        success: function (output) {
                            //alert(output.message);
                            if (output.status == 1) {
                                toastr.success(output.message);
                                jQuery(window).load(function () {
                                    jQuery("div#reload_me").empty();
                                    jQuery("div#reload_me").load(window.location.assign(href) + " div#reload_me > *");
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
    <style>
        .list-group-item {
            padding: 1rem 1rem;
        }
    </style>
@endsection
