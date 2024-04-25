@extends('admin.layouts.master')

@section('title', 'Posts')

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
                    @component('component.form')
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
                                    <label class="radio-inline">
                                    {{ Form::radio('which_editor', 'normal', (!empty($post) ? (($post->which_editor == 'normal') ? 'normal' : '') : ''), ['class' => 'radio']) }}                                
                                        <img width="200px" style="border: 1px solid #DDD; padding: 5px;" src="{{ $publicDir }}/images/normal.png" />
                                    </label>
                                    <label class="radio-inline">
                                    {{ Form::radio('which_editor', 'grapes', (!empty($post) ? (($post->which_editor == 'grapes') ? 'grapes' : '') : ''), ['class' => 'radio']) }}
                                        <img width="200px" style="border: 1px solid #DDD; padding: 5px;" src="{{ $publicDir }}/images/grapes.png" />
                                    </label>
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
                            <div class="form-group">
                                {{ Form::label('author', 'Author/Contact Person', array('class' => 'author')) }}
                                {{ Form::text('author', (!empty($post->author) ? $post->author : NULL), ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Enter author...']) }}
                            </div>
                            @if(!empty($post->which_editor) && $post->which_editor == 'grapes')
                                <div class="form-group mb-2 text-center d-block" style="padding: 30px;border: 1px dashed #ddd;background: #f9f9f9;">
                                    <a href="{{ route('common_post_edit', $post->id) }}?which_editor=grapes" class="btn btn-xl btn-success">
                                        Edit with grapes
                                    </a>
                                </div>                    
                            @else
                                <div class="form-group mb-2">
                                    {{ Form::label('description', 'Description', array('class' => 'description')) }}
                                    {{ Form::textarea('description', (!empty($post->description) ? $post->description : NULL), ['required', 'class' => 'form-control', 'id' => 'wysiwyg', 'placeholder' => 'Enter details content...']) }}
                                </div>
                            @endif
                            <div class="form-group">
                                {{ Form::label('images', 'Image ID/s', array('class' => 'images')) }}
                                @if(!empty($post->images))
                                    <?php
                                    //$im = image_ids($product->images, TRUE, TRUE);
                                    $im = $post->images;
                                    ?>
                                    {{ Form::text('images', (!empty($im) ? $im : NULL), ['type' => 'text', 'id' => 'image_ids', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...']) }}
                                @else
                                    {{ Form::text('images', NULL, ['type' => 'text', 'id' => 'image_ids', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...']) }}
                                @endif
                                <small id="show_image_names"></small>

                            </div>
                            <div class="form-group">
                                @if(!empty($post->images))
                                    <?php
                                    $images = explode(',', $post->images);

                                    $html = null;
                                    foreach ($images as $image) :
                                        $img = App\Models\Media::find($image);
                                        //dump($img);
                                        if($img):
                                        $html .= '<img src="' . url($img->icon_size_directory) . '" alt="' . $img->original_name . '" class="margin" style="max-width: 80px; max-height: 80px; border: 1px dotted #ddd;">';
                                        //$html .= '<span>' . $img->id . '</span>';
                                        $html .= '<a href="' . url('delete_attribute', ['id' => $img->id]) . '">x</a>';
                                        //$attributes_p = product_attributes($product, TRUE);
                                        endif;
                                    endforeach;
                                    //die();
                                    ?>
                                    {!! $html !!}
                                @endif
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="category-tab" data-bs-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="true">Category</a>
                                        </li>                                
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="seo-tab" data-bs-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">SEO Information</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Others</a>
                                        </li>
                                        
                                    </ul>
                                    <div class="tab-content mt-3 mb-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                                    
                                            <div class="form-group">
                                                {{ Form::label('short_description', 'Short Description', array('class' => 'short_description')) }}
                                                {{ Form::textarea('short_description', (!empty($post->short_description) ? $post->short_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short description...']) }}
                                            </div>

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
                                            
                                        </div>
                                        <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">                                
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
                                        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                            
                                            <div class="form-group">
                                                <label>
                                                    {{ Form::label('h1tag', 'H1 Tag', array('class' => 'h1tag')) }}
                                                </label>    
                                                {{ Form::text('h1tag', $post->h1tag??'', ['class' => 'form-control', 'placeholder' => 'Enter h1 tag...']) }}
                                            </div>

                                            <div class="form-group">
                                                <label>
                                                {{ Form::label('h2tag', 'H2Tag', array('class' => 'h2tag')) }}
                                                </label>
                                                {{ Form::text('h2tag', $post->h2tag??'', ['class' => 'form-control', 'placeholder' => 'Enter h2tag...']) }}

                                            </div>

                                            <div class="form-group">
                                                <label>
                                                        {{ Form::label('seo_title', 'Seo Title', array('class' => 'seo_title')) }}
                                                </label>
                                                    {{ Form::text('seo_title', $post->seo_title??'', ['class' => 'form-control', 'placeholder' => 'Enter seo title...']) }}
                                            </div>

                                            <div class="form-group">
                                                {{ Form::label('seo_description', 'Seo Description', array('class' => 'seo_description')) }}
                                                {{ Form::textarea('seo_description', (!empty($post->seo_description) ? $post->seo_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter seo description...']) }}
                                            </div>

                                            <div class="form-group">
                                                {{ Form::label('seo_keywords', 'Seo Keywords', array('class' => 'seo_keywords')) }}
                                                {{ Form::textarea('seo_keywords', (!empty($post->seo_keywords) ? $post->seo_keywords : NULL), ['class' => 'form-control', 'placeholder' => 'Enter short keywords...']) }}
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">


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
<link rel="stylesheet" href="{{ $publicDir }}/assets/grapes/css/grapes.min.css">
<script src="{{ $publicDir }}/assets/grapes/grapes.min.js"></script>
<script type="text/javascript">
    var editor = grapesjs.init({
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        height: '100%',
        fromElement: true,
        storageManager: {
            type: 'remote',
            stepsBeforeSave: 0,
            autosave: true,         // Store data automatically
            autoload: true,
            urlStore: "{{ route('common_post_grapes_update') }}?id={{ $post->id }}",
            urlLoad: "{{ route('common_post_grapes_load_now') }}?id={{ $post->id }}",            
            contentTypeJson: true,
            storeComponents: true,
            storeStyles: true,
            storeHtml: true,
            storeCss: true,
            headers: { 'Content-Type': 'application/json' },
            // json_encode:{
            //     "gjs-html": [],
            //     "gjs-css": [],
            // }            
        },
        styleManager : {
            sectors: [{
                name: 'General',
                open: false,
                buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
            }, {
                name: 'Flex',
                open: false,
                buildProps: ['flex-direction', 'flex-wrap', 'justify-content', 'align-items', 'align-content', 'order', 'flex-basis', 'flex-grow', 'flex-shrink', 'align-self']
            }, {
                name: 'Dimension',
                open: false,
                buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
            }, {
                name: 'Typography',
                open: false,
                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
            }, {
                name: 'Decorations',
                open: false,
                buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
            }, {
                name: 'Extra',
                open: false,
                buildProps: ['transition', 'perspective', 'transform'],
            }
            ],
        },
    });

    editor.BlockManager.add('testBlock', {
        label: 'Block',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: `<div style="padding-top:50px; padding-bottom:50px; text-align:center">Test block</div>`
    });
</script>
<script src="{{ URL::asset('public/plugins/dropzone.js') }}"></script>
<script src="{{ URL::asset('public/js/dropzone-config.js') }}"></script>
<script type="text/javascript">
    function get_id(identifier) {
        //alert("data-id:" + jQuery(identifier).data('id') + ", data-option:" + jQuery(identifier).data('option'));


        var dataid = jQuery(identifier).data('id');
        jQuery('#image_ids').val(
            function (i, val) {
                return val + (!val ? '' : ', ') + dataid;
            });
        var option = jQuery(identifier).data('option');
        jQuery('#show_image_names').html(
            function (i, val) {
                return val + (!val ? '' : ', ') + option;
            }
        );
    }

    /**
        *
        */
    jQuery(document).ready(function ($) {
        $.noConflict();

        $('#title').blur(function () {
            var m = $(this).val();
            var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
            var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

            $('#seo_url').val(cute);
        });

    });
</script>
<script>
    jQuery(document).ready(function ($) {

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            defaultViewDate: {
                year: {{\Carbon\Carbon::parse($post->created_at??'')->format('Y')??''}},
                month: {{\Carbon\Carbon::parse($post->created_at??'')->format('m')??''}},
                day: {{\Carbon\Carbon::parse($post->created_at??'')->format('d')??''}}
            }
        })

    } );
</script>
@endsection