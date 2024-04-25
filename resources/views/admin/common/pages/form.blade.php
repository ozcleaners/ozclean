@extends('admin.layouts.master')

@section('title')
    Add Page
@endsection
@section('filter')
    <a href="{{ route('common_page_index') }}" class="btn btn-sm btn-success py-0">Back</a>
@endsection

@section('content')

@if(request()->get('which_editor') == 'grapes')
    <div class="content-wrapper">
        <div id="gjs" style="height:0px; overflow:hidden;">
        </div>
    </div>
@else
    <div class="content-wrapper">
        <div class="row">
            @if(Session::has('success'))
            <div class="col-md-12">
                <div class="callout callout-success">
                    {{ Session::get('success') }}
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="col-md-12">
                <div class="callout callout-danger">
                    <h4>Warning!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <div class="col-md-8">
                @component('components.form')
                    @slot('form_id')
                        @if (!empty($user->id))
                            page_forms
                        @else
                            page_form
                        @endif
                    @endslot

                    @slot('title')
                        @if (!empty($page->id))
                        Edit page
                        @else
                        Add a new page
                        @endif
                    @endslot

                @slot('route')
                    @if (!empty($page->id))
                        {{ route('common_page_update', $page->id) }}
                    @else
                        {{ route('common_page_store') }}
                    @endif
                @endslot

                @slot('method')
                    @if (!empty($page->id))
                        {{method_field('POST')}}
                    @endif
                @endslot

                @slot('fields')
                {{ Form::hidden('user_id', (!empty(\Auth::user()->id) ? \Auth::user()->id : NULL), ['type' => 'hidden']) }}
                {{ Form::hidden('lang', (!empty($page->lang) ? $page->lang : 'en'), ['type' => 'hidden']) }}
                {{ Form::hidden('page_id', (!empty($page->id) ? $page->id : ''), ['type' => 'hidden']) }}



                <div class="form-group mb-3">
                    {{ Form::label('template', 'Use dynamic template', array('class' => 'template')) }}
                    @php
                        $dir    = resource_path('/views/frontend/templates/page');
                        $files = scandir($dir);
                        $template = array_diff(scandir($dir), array('.', '..'))
                    @endphp
                    <select name="template" class="form-select" id="template">
                        <option value="">Select a dynamic template</option>
                        @foreach($template as $file)
                            @php
                                $getFileName = explode(".blade.php", $file);
                                $checkFile =  str_contains($file, '.blade.php');
                            @endphp
                            @if($checkFile == 1)
                                <option value="{{$getFileName[0]}}" {{ !empty($page) && $page->template == $getFileName[0] ? 'selected' : '' }}>
                                    {{ ucwords($getFileName[0]) }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    {{ Form::label('which_editor', 'Which editor?', array('class' => 'which_editor')) }}
                        <div class="form-check d-inline-block">
                            <label class="radio-inline">
                            {{ Form::radio('which_editor', 'normal', (!empty($page) ? (($page->which_editor == 'normal') ? 'normal' : '') : ''), ['class' => 'radio']) }}
                                <img width="100px" style="border: 1px solid #DDD; padding: 5px;" src="{{ $publicDir }}/images/normal.png" />
                            </label>
                            <label class="radio-inline">
                            {{ Form::radio('which_editor', 'grapes', (!empty($page) ? (($page->which_editor == 'grapes') ? 'grapes' : '') : ''), ['class' => 'radio']) }}
                                <img width="100px" style="border: 1px solid #DDD; padding: 5px;" src="{{ $publicDir }}/images/grapes.png" />
                            </label>
                        </div>
                    </div>
                <div class="form-group">
                    {{ Form::label('title', 'Title', array('class' => 'title')) }}
                    {{ Form::text('title', (!empty($page->title) ? $page->title : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter title...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('sub_title', 'Sub Title', array('class' => 'sub_title')) }}
                    {{ Form::text('sub_title', (!empty($page->sub_title) ? $page->sub_title : NULL), ['class' => 'form-control', 'placeholder' => 'Enter sub_title...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('seo_url', 'Search Engine Friendly URL', array('class' => 'seo_url')) }}
                    {{ Form::text('seo_url', (!empty($page->seo_url) ? $page->seo_url : NULL), ['type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => 'Enter seo URL...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('author', 'Author/Contact Person', array('class' => 'author')) }}
                    {{ Form::text('author', (!empty($post->author) ? $post->author : NULL), ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter author...']) }}
                </div>
                @if(!empty($page->which_editor) && $page->which_editor == 'grapes')
                    <div class="form-group mb-2 text-center d-block" style="padding: 30px;border: 1px dashed #ddd;background: #f9f9f9;">
                        <a href="{{ route('common_page_edit', $page->id) }}?which_editor=grapes" class="btn btn-xl btn-success">
                            Edit with grapes
                        </a>
                    </div>
                @else
                    <div class="form-group mb-2">
                        {{ Form::label('description', 'Description', array('class' => 'description')) }}
                        {{ Form::textarea('description', (!empty($page->description) ? $page->description : NULL), ['class' => 'form-control', 'id' => 'wysiwyg', 'placeholder' => 'Enter details content...']) }}
                    </div>
                @endif
                <div class="form-group">
                    {{ Form::label('images', 'Image ID/s', array('class' => 'images')) }}
                    @if(!empty($page->images))
                    <?php
                    // $im = image_ids($page);
                    $im = $page->images;
                    ?>
                    {{ Form::text('images', (!empty($im) ? $im : NULL), ['type' => 'text', 'id' => 'image_ids', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...']) }}
                    @else
                    {{ Form::text('images', NULL, ['type' => 'text', 'id' => 'image_ids', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...']) }}
                    @endif

                    <small id="show_image_names"></small>
                </div>

                <div class="form-group">
                    @if(!empty($page))
                    {{-- {!!  uploaded_photos($page) !!}--}}
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('is_sticky', 'Is it sticky?', array('class' => 'is_sticky')) }}

                    <div class="form-check d-inline-block">
                        <label class="radio-inline d-block">
                            {{ Form::radio('is_sticky', 1, ((!empty($page) ? $page->is_sticky == 1 : 1) ? TRUE : FALSE), ['class' => 'radio']) }}
                            Yes. This page will be marked as selected top page
                        </label>
                        <label class="radio-inline  d-block">
                            {{ Form::radio('is_sticky', 0, ((!empty($page) ? $page->is_sticky == 0 : 0) ? TRUE : FALSE), ['class' => 'radio']) }}
                            No. This page will no be marked as selected top page
                        </label>
                    </div>
                </div>

                <div class="form-group">
                {{ Form::label('is_active', 'Will it be active?', array('class' => 'is_active')) }}

                    <div class="form-check d-inline-block">
                        <label class="radio-inline d-block">
                        {{ Form::radio('is_active', 1, (!empty($page) ? (($page->is_active == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                            Yes. This page will publish
                        </label>
                        <label class="radio-inline  d-block">
                        {{ Form::radio('is_active', 0, (!empty($page) ? (($page->is_active == 0) ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                            No. This page will save as draft
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('short_description', 'Short Description', array('class' => 'short_description')) }}
                    {{ Form::textarea('short_description', (!empty($page->short_description) ? $page->short_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short description...']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('youtube', 'Youtube', array('class' => 'youtube')) }}
                    {{ Form::text('youtube', (!empty($page->youtube) ? $page->youtube : NULL), ['class' => 'form-control', 'placeholder' => 'Enter youtube...']) }}
                </div>
                <div class="form-group">
                    <label>
                        {{ Form::label('h1tag', 'H1 Tag', array('class' => 'h1tag')) }}
                    </label>
                    {{ Form::text('h1tag', $page->h1tag??'', ['class' => 'form-control', 'placeholder' => 'Enter h1 tag...']) }}
                </div>

                <div class="form-group">
                    <label>
                    {{ Form::label('h2tag', 'H2Tag', array('class' => 'h2tag')) }}
                    </label>
                    {{ Form::text('h2tag', $page->h2tag??'', ['class' => 'form-control', 'placeholder' => 'Enter h2tag...']) }}

                </div>

                <div class="form-group">
                    <label>
                            {{ Form::label('seo_title', 'Seo Title', array('class' => 'seo_title')) }}
                    </label>
                        {{ Form::text('seo_title', $page->seo_title??'', ['class' => 'form-control', 'placeholder' => 'Enter seo title...']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('seo_description', 'Seo Description', array('class' => 'seo_description')) }}
                    {{ Form::textarea('seo_description', (!empty($page->seo_description) ? $page->seo_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter seo description...']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('seo_keywords', 'Seo Keywords', array('class' => 'seo_keywords')) }}
                    {{ Form::textarea('seo_keywords', (!empty($page->seo_keywords) ? $page->seo_keywords : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short keywords...']) }}
                </div>


                @endslot
                @endcomponent
            </div>

        </div>
    </div>
@endif
@endsection

@section('cusjs')

@if(request()->get('which_editor') == 'grapes')
@include('components.grapesjs')

<script type="text/javascript">
    // For grapes only
    let storeUrl = "{{ route('common_page_grapes_update') }}?id={{ $page->id ?? null }}";
    let loadUrl = "{{ route('common_page_grapes_load_now') }}?id={{ $page->id ?? null }}";

    grapesLoader(storeUrl, loadUrl);
</script>
@endif

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.noConflict();

        $('#title').blur(function () {
            var m = $(this).val();
            var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
            var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

            $('#seo_url').val(cute);
        });

    });
    function get_id(identifier) {
        //alert("data-id:" + jQuery(identifier).data('id') + ", data-option:" + jQuery(identifier).data('option'));
        var dataid = jQuery(identifier).data('id');
        jQuery('#image_ids').val(
            function(i, val) {
                return val + (!val ? '' : ', ') + dataid;
            });
        var option = jQuery(identifier).data('option');
        jQuery('#show_image_names').html(
            function(i, val) {
                return val + (!val ? '' : ', ') + option;
            }
        );
    }
</script>
@endsection
