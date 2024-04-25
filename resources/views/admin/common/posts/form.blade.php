@extends('admin.layouts.master')

@section('title')
    Add Post
@endsection
@section('filter')
    <a href="{{ route('common_post_index') }}" class="btn btn-sm btn-success py-0">Back</a>
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

                <div class="col-md-9">
                    @component('components.form')
                        @slot('form_id')
                            @if (!empty($user->id))
                                post_forms
                            @else
                                post_form
                            @endif
                        @endslot

                        @slot('title')
                            @if (!empty($post->id))
                                Edit post
                            @else
                                Add a new post
                            @endif

                        @endslot

                        @slot('route')
                            @if (!empty($post->id))
                                {{ route('common_post_update') }}
                            @else
                                {{ route('common_post_store') }}
                            @endif
                        @endslot
                        @slot('method')
                            @if (!empty($post->id))
                                {{method_field('POST')}}
                            @endif
                        @endslot

                        @slot('fields')
                            {{ Form::hidden('user_id', (!empty(\Auth::user()->id) ? \Auth::user()->id : NULL), ['type' => 'hidden']) }}
                            {{ Form::hidden('lang', (!empty($post->lang) ? $post->lang : 'en'), ['type' => 'hidden']) }}
                            {{ Form::hidden('post_id', (!empty($post->id) ? $post->id : ''), ['type' => 'hidden']) }}

                            <div class="form-group mb-3">
                                {{ Form::label('which_editor', 'Which editor?', array('class' => 'which_editor')) }}

                                <div class="form-check d-inline-block">
                                    {{ Form::radio('which_editor', 'normal', 'normal') }}
                                    {{--                                    <label class="radio-inline">--}}
                                    {{--                                        {{ Form::radio('which_editor', 'normal', (!empty($post) ? (($post->which_editor == 'normal') ? 'normal' : '') : ''), ['class' => 'radio']) }}--}}
                                    {{--                                        <img width="100px" style="border: 1px solid #DDD; padding: 5px;"--}}
                                    {{--                                             src="{{ $publicDir }}/images/normal.png"/>--}}
                                    {{--                                    </label>--}}
                                    {{--                                    <label class="radio-inline">--}}
                                    {{--                                        {{ Form::radio('which_editor', 'grapes', (!empty($post) ? (($post->which_editor == 'grapes') ? 'grapes' : '') : ''), ['class' => 'radio']) }}--}}
                                    {{--                                        <img width="100px" style="border: 1px solid #DDD; padding: 5px;"--}}
                                    {{--                                             src="{{ $publicDir }}/images/grapes.png"/>--}}
                                    {{--                                    </label>--}}
                                    {{--                                    <label class="radio-inline">--}}
                                    {{--                                        {{ Form::radio('which_editor', 'section', (!empty($post) ? (($post->which_editor == 'section') ? 'section' : '') : ''), ['class' => 'radio']) }}--}}
                                    {{--                                        <img width="100px" style="border: 1px solid #DDD; padding: 5px;"--}}
                                    {{--                                             src="{{ $publicDir }}/images/section.png"/>--}}
                                    {{--                                    </label>--}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('title', 'Title', array('class' => 'title')) }}
                                {{ Form::text('title', (!empty($post->title) ? $post->title : old('title')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter title...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('sub_title', 'Sub Title', array('class' => 'sub_title')) }}
                                {{ Form::text('sub_title', (!empty($post->sub_title) ? $post->sub_title : NULL), ['class' => 'form-control', 'placeholder' => 'Enter sub_title...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('seo_url', 'Search Engine Friendly URL', array('class' => 'seo_url')) }}
                                {{ Form::text('seo_url', (!empty($post->seo_url) ? $post->seo_url : NULL), ['type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => 'Enter seo URL...']) }}
                            </div>

                            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                @component('components.media_manager_template', [ 'media_array' => [
                                        'button_id' => 'images',
                                        'label' => 'Image',
                                        'input_name' => 'images',
                                        'row_information' => $post ?? NULL,
                                        'script_load' => TRUE
                                        ]])
                                @endcomponent
                            </div>
                            @if(!empty($post))
                                @if(!empty($post->which_editor) && $post->which_editor == 'grapes')
                                    <div class="form-group mb-2 text-center d-block"
                                         style="padding: 30px;border: 1px dashed #ddd;background: #f9f9f9;">
                                        <a href="{{ route('common_post_edit', $post->id) }}?which_editor=grapes"
                                           class="btn btn-xl btn-success">
                                            Edit with grapes
                                        </a>
                                    </div>
                                @else
                                    <div class="form-group mb-2">
                                        <div class="float-end">
                                            <a class="btn btn-sm btn-success py-0"
                                               href="{{ route('common_post_custom_field_edit', $post->id) }}">
                                                Custom Content
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        {{ Form::label('description', 'Description', array('class' => 'description')) }}
                                        {{ Form::textarea('description', (isset($post) && !empty($post->description) ? $post->description : NULL), ['class' => 'form-control', 'id' => 'wysiwyg', 'placeholder' => 'Enter details content...']) }}
                                    </div>
                                @endif
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-12">

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                               role="tab" aria-controls="home" aria-selected="true">Basic</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="seo-tab" data-bs-toggle="tab" href="#seo" role="tab"
                                               aria-controls="seo" aria-selected="false">SEO Information</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#other"
                                               role="tab" aria-controls="other" aria-selected="false">Others</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content mt-3 mb-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <div class="form-group">
                                                {{ Form::label('categories', 'Categories ', array('class' => 'categories images')) }}
                                                <div class="pre-scrollable">
                                                    <?php
                                                    if (!empty($post->categories)) {
                                                        $ids = explode(',', $post->categories);
                                                    } else {
                                                        $ids = array();
                                                    }
                                                    //dump($ids);
                                                    ?>
                                                    {!! category_h_checkbox_html($cats, 1, " - ", !empty($ids) ? $ids : array()) !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('short_description', 'Short Description', array('class' => 'short_description')) }}
                                                {{ Form::textarea('short_description', (!empty($post->short_description) ? $post->short_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short description...']) }}
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                            @php
                                                $seoHelperParam = [
                                                    'form' => false,
                                                    'save_btn' => false,
                                                    'required' => false,
                                                    'content_id' => !empty($post) ? $post->id : null,
                                                    'update_row_id_name' => 'seo_information_row_id',
                                                ];
                                                echo \App\Helpers\SeoInformationForm::getForm('Post', $seoHelperParam);
                                            @endphp
                                        </div>
                                        <div class="tab-pane fade" id="other" role="tabpanel"
                                             aria-labelledby="other-tab">
                                            <div class="form-group">
                                                {{ Form::label('is_sticky', 'Is it sticky?', array('class' => 'cat_theme')) }}

                                                <div class="form-check d-inline-block">
                                                    <label class="radio-inline d-block">
                                                        {{ Form::radio('is_sticky', 1, (!empty($post) ? (($post->is_sticky == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                                        Yes. This post will be marked as selected top post
                                                    </label>
                                                    <label class="radio-inline  d-block">
                                                        {{ Form::radio('is_sticky', 0, (!empty($post) ? (($post->is_sticky == 0) ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                                                        No. This post will no be marked as selected top post
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('is_active', 'Will it be active?', array('class' => 'is_active')) }}

                                                <div class="form-check d-inline-block">
                                                    <label class="radio-inline d-block">
                                                        {{ Form::radio('is_active', 1, (!empty($post) ? (($post->is_active == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                                        Yes. This post will publish
                                                    </label>
                                                    <label class="radio-inline  d-block">
                                                        {{ Form::radio('is_active', 0, (!empty($post) ? (($post->is_active == 0) ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                                                        No. This post will save as draft
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('position', 'Position', array('class' => 'position')) }}
                                                <div class="form-check d-inline-block">
                                                    <label class="radio-inline  d-block">
                                                        @php
                                                            $getPositionValue = $Query::getEnumValues('posts', 'position');
                                                        @endphp
                                                        @foreach($getPositionValue as $value)
                                                            <label class="radio-inline d-block">
                                                                <input class="radio"
                                                                       {{!empty($post) && $post->position == $value ? 'checked' : '' }} name="position"
                                                                       type="radio"
                                                                       value="{{$value}}"
                                                                       id="position"> {{$value}}
                                                            </label>
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('font_awesome_icon', 'Font Awesome Icon', array('class' => 'font_awesome_icon')) }}
                                                {{ Form::text('font_awesome_icon', (!empty($post->font_awesome_icon) ? $post->font_awesome_icon : NULL), ['class' => 'form-control', 'placeholder' => 'Enter Font awesome Class...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('author', 'Author/Contact Person', array('class' => 'author')) }}
                                                {{ Form::text('author', (!empty($post->author) ? $post->author : NULL), ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter author...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('is_upcoming', 'Is it upcoming?', array('class' => 'is_upcoming')) }}

                                                <div class="form-check d-inline-block">
                                                    <label class="radio-inline d-block">
                                                        {{ Form::radio('is_upcoming', 1, (!empty($post) ? (($post->is_upcoming == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline  d-block">
                                                        {{ Form::radio('is_upcoming', 0, (!empty($post) ? (($post->is_upcoming == 0) ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('lang', 'Language', array('class' => 'lang')) }}

                                                <div class="form-check d-inline-block">
                                                    <label class="radio-inline d-block">
                                                        {{ Form::radio('lang', 1, (!empty($post) ? ((!empty($post->lang) ? $post->lang == 1 : 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                                        English
                                                    </label>
                                                    <label class="radio-inline  d-block">
                                                        {{ Form::radio('lang', 0, (!empty($post) ? ((!empty($post->lang) ? $post->lang == 0 : 0) ? FALSE : TRUE) : null), ['class' => 'radio']) }}
                                                        Bengali
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('is_auto_post', 'Is facebook auto post?', array('class' => 'is_auto_post')) }}

                                                <div class="form-check d-inline-block">
                                                    <label class="radio-inline d-block">
                                                        {{ Form::radio('is_auto_post', 1, (!empty($post) ? (($post->is_auto_post == 1) ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                                        Yes
                                                    </label>
                                                    <label class="radio-inline  d-block">
                                                        {{ Form::radio('is_auto_post', 0, (!empty($post) ? (($post->is_auto_post == 0) ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('youtube', 'Youtube', array('class' => 'youtube')) }}
                                                {{ Form::text('youtube', (!empty($post->youtube) ? $post->youtube : NULL), ['class' => 'form-control', 'placeholder' => 'Enter youtube...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('publish_date', 'Published Date', array('class' => 'publish_date')) }}
                                                {{ Form::text('created_at', $post->created_at??'', ['class' => 'form-control datepicker', 'placeholder' => 'Enter date...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('brand', 'Left Margin for timeline slider', array('class' => 'brand')) }}
                                                {{ Form::text('brand', (!empty($post->brand) ? $post->brand : NULL), ['class' => 'form-control', 'placeholder' => 'Enter left margin for timeline slider...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('phone', 'Phone', array('class' => 'phone')) }}
                                                {{ Form::text('phone', (!empty($post->phone) ? $post->phone : old('phone')), ['class' => 'form-control', 'placeholder' => 'Enter phone...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('opening_hours', 'Opening Hours', array('class' => 'opening_hours')) }}
                                                {{ Form::text('opening_hours', (!empty($post->opening_hours) ? $post->opening_hours : NULL), ['class' => 'form-control', 'placeholder' => 'Enter opening hours...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('latitude', 'Latitude', array('class' => 'latitude')) }}
                                                {{ Form::text('latitude', (!empty($post->latitude) ? $post->latitude : NULL), ['class' => 'form-control', 'placeholder' => 'Enter latitude...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('longitude', 'Longitude', array('class' => 'longitude')) }}
                                                {{ Form::text('longitude', (!empty($post->longitude) ? $post->longitude : NULL), ['class' => 'form-control', 'placeholder' => 'Enter longitude...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('phone_numbers', 'Phone Numbers', array('class' => 'phone_numbers')) }}
                                                {{ Form::text('phone_numbers', (!empty($post->phone_numbers) ? $post->phone_numbers : NULL), ['class' => 'form-control', 'placeholder' => 'Enter phone numbers...']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('address', 'Address', array('class' => 'address')) }}
                                                {{ Form::textarea('address', (!empty($post->address) ? $post->address : NULL), ['class' => 'form-control', 'placeholder' => 'Enter address...']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            let storeUrl = "{{ route('common_post_grapes_update') }}?id={{ $post->id ?? null }}";
            let loadUrl = "{{ route('common_post_grapes_load_now') }}?id={{ $post->id ?? null }}";

            grapesLoader(storeUrl, loadUrl);
        </script>
    @else
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $.noConflict();

                $('#title').blur(function () {
                    var m = $(this).val();
                    var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
                    var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

                    $('#seo_url').val(cute);
                });


                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    defaultViewDate: {
                        year: {{\Carbon\Carbon::parse($post->created_at??'')->format('Y')??''}},
                        month: {{\Carbon\Carbon::parse($post->created_at??'')->format('m')??''}},
                        day: {{\Carbon\Carbon::parse($post->created_at??'')->format('d')??''}}
                    }
                });

            });
        </script>
    @endif
@endsection

