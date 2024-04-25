@extends('admin.layouts.master')

@section('title', 'Posts')

@section('filter')
    <div id="dt_filter"></div>
@endsection

@section('content')
    <div class="table-wrapper desktop-view mobile-view">
        <table class="table table-hover" id="posts">
        </table>
    </div>
@endsection

@section('breadcrumb-bottom')
    <div id="dt_pageinfo"></div>
@endsection

@section('cusjs')
    @include('components.datatable')

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

            let field = [
                {"data": 'button'},
                {"title": "<span>Name</span>", "data": 'title'},
                {"title": "Sub Title", "data": "sub_title"},
                {"title": "SEO URL", "data": "seo_url"},
                {"title": "Terms", "data": "categories"},
                {"title": "Author", "data": "author"},
                {"title": "Description", "data": "description"}
            ];
            loadDatatable("#posts", "{{ route('common_post_api_get') }}", field);

        });

        function myFunction(id) {
            /* Get the text field */
            var copyText = document.getElementById("myInput" + id);

            /* Select the text field */
            copyText.select();

            /* Copy the text inside the text field */
            document.execCommand("copy");

            document.getElementById('copied').innerText = 'Copied the URL: ' + copyText.value;
            /* Alert the copied text */
            //alert("Copied the text: " + copyText.value);
            //http://103.218.26.178:2145/pourashova/page/42/physical-infrastructure
        }

        function copyName(id) {
            /* Get the text field */
            var copyText = document.getElementById("copyNameID" + id);

            /* Select the text field */
            copyText.select();

            /* Copy the text inside the text field */
            document.execCommand("copy");

            document.getElementById('copied').innerText = 'Copied the name: ' + copyText.value;
            /* Alert the copied text */
            //alert("Copied the text: " + copyText.value);
            //http://103.218.26.178:2145/pourashova/page/42/physical-infrastructure
        }
    </script>
@endsection
