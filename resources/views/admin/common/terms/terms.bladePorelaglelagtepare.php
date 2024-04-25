@extends('admin.layouts.master')

@section('title')
    Categories
@endsection
@section('filter')
    @if(request()->id)
        <a href="{{ route('common_term_edit', request()->id) }}" class="btn btn-sm btn-success py-0">Back</a>
    @endif
@endsection
@section('content')
    @if(request()->get('which_editor') == 'grapes')
        <div class="content-wrapper">
            <div id="gjs" style="height:0px; overflow:hidden;">

            </div>
        </div>
    @elseif(request()->get('which_editor') == 'term_custom_field')
        @include('admin.common.terms.term_rich_content')
    @else
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-8" id="signupForm">
                    @component('components.form')

                        @slot('form_id')
                            @if (!empty($term->id))
                                term_form333
                            @else
                                term_form333
                            @endif
                        @endslot
                        @slot('title')
                            @if (!empty($term->id))
                                Edit a term
                            @else
                                Add a new term
                            @endif
                        @endslot
                        @slot('route')
                            @if (!empty($term->id))
                                {{ route('common_term_update') }}
                            @else
                                {{route('common_term_store')}}
                            @endif
                        @endslot
                        @slot('fields')
                            {{ Form::hidden('term_id', (!empty($term->id) ? $term->id : ''), ['type' => 'hidden']) }}
                            {{ Form::hidden('which_editor', (!empty($term->which_editor) ? $term->which_editor : 'normal'), ['type' => 'hidden']) }}
                            {{--                            <div class="form-group mb-3">--}}
                            {{--                                {{ Form::label('which_editor', 'Which editor?', array('class' => 'which_editor')) }}--}}

                            {{--                                <div class="form-check d-inline-block">--}}
                            {{--                                    <label class="radio-inline">--}}
                            {{--                                        {{ Form::radio('which_editor', 'normal', (!empty($term) ? (($term->which_editor == 'normal') ? 'normal' : '') : 'normal'), ['class' => 'radio', 'selected' => 'selected']) }}--}}
                            {{--                                        <img width="100px" style="border: 1px solid #DDD; padding: 5px;"--}}
                            {{--                                             src="{{ $publicDir }}/images/normal.png"/>--}}
                            {{--                                    </label>--}}
                            {{--                                    <label class="radio-inline">--}}
                            {{--                                        {{ Form::radio('which_editor', 'grapes', (!empty($term) ? (($term->which_editor == 'grapes') ? 'grapes' : '') : ''), ['class' => 'radio']) }}--}}
                            {{--                                        <img width="100px" style="border: 1px solid #DDD; padding: 5px;"--}}
                            {{--                                             src="{{ $publicDir }}/images/grapes.png"/>--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="form-group mb-3">
                                {{ Form::label('calculator_template', 'Calculator Template', array('class' => 'calculator_template')) }}

                                <div class="form-check d-inline-block">
                                    <label class="radio-inline">
                                        {{ Form::radio('calculator_template', 'regular', (!empty($term) ? (($term->calculator_template == 'regular') ? 'regular' : '') : 'regular'), ['class' => 'radio', 'selected' => 'selected']) }}
                                        Regular
                                        {{--                                        <img width="100px" style="border: 1px solid #DDD; padding: 5px;"--}}
                                        {{--                                             src="{{ $publicDir }}/images/normal.png"/>--}}
                                    </label>
                                    <label class="radio-inline">
                                        {{ Form::radio('calculator_template', 'breakdown', (!empty($term) ? (($term->calculator_template == 'breakdown') ? 'breakdown' : '') : ''), ['class' => 'radio']) }}
                                        Breakdown
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('term_name', 'Term Name', array('class' => 'term_name')) }}
                                {{ Form::text('term_name', (!empty($term->name) ? $term->name : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter term name...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('term_subtitle', 'Term Sub Title', array('class' => 'term_subtitle')) }}
                                {{ Form::text('term_subtitle', (!empty($term->term_subtitle) ? $term->term_subtitle : NULL), ['class' => 'form-control', 'placeholder' => 'Enter term sub title...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('seo_url', 'SEO URL', array('class' => 'seo_url')) }}
                                {{ Form::text('seo_url', (!empty($term->seo_url) ? $term->seo_url : NULL), ['required', 'data-type' => (!empty($product->id) ? 'update' : 'create'), 'id' => 'seo_url', 'class' => 'form-control', 'placeholder' => 'Enter seo url...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('term_position', 'Term Position', array('class' => 'term_position')) }}
                                <?php
                                $info = App\Models\Term::latest()->first();
                                if (!empty($info)) {
                                    $id = $info->id + 1;
                                } else {
                                    $id = 1;
                                }
                                ?>
                                {{ Form::text('term_position', (!empty($term->position) ? $term->position : $id), ['class' => 'form-control', 'placeholder' => 'Enter term name...', 'readonly' => 'readonly']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('term_parent', 'Term Parent', array('class' => 'term_parent')) }}

                                <select name="term_parent" id="level_no_get" class="form-control">
                                    <option value="">Select a parent</option>
                                    {!! select_option_html($cats, $parent = 0, ' ', (!empty($term->parent) ? $term->parent : NULL), FALSE ) !!}
                                </select>
                            </div>
                            <div class=" mt-3">&nbsp;</div>
                            @php
                                $parentParentCategoryId = $Model('Term')::where('id', $term->parent ?? NULL)->first()->parent ?? NULL;
                            @endphp
                            @if(!empty($term->id) && ($Model('Term')::getChildsByCategoryId(['term_id' => $term->id ?? NULL, 'parent_parent_id' => $term->parent ?? NULL, 'parent_parent_parent_id' => $parentParentCategoryId ?? NULL]) == TRUE))
                                <div class="float-end">
                                    <a class="btn btn-sm btn-success py-0"
                                       href="{{ route('common_term_custom_field_edit', $term->id) }}">
                                        Zone
                                    </a>
                                    <a class="btn btn-sm btn-warning py-0"
                                       href="{{ route('calculator_setting_index', $term->id) }}">
                                        Calc Basic
                                    </a>
                                    <a class="btn btn-sm btn-info py-0"
                                       href="{{ route('calculator_service_setting_index', $term->id) }}">
                                        Calc Service
                                    </a>

                                </div>
                            @endif
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item d-none" role="presentation">
                                    <a class="nav-link " id="home-tab" data-bs-toggle="tab" href="#home"
                                       role="tab" aria-controls="home" aria-selected="true">Basic</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                       href="#details"
                                       role="tab" aria-controls="details" aria-selected="true">Details</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="urls-tab" data-bs-toggle="tab" href="#urls"
                                       role="tab"
                                       aria-controls="urls" aria-selected="true">URLs</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="seo-tab" data-bs-toggle="tab" href="#seo" role="tab"
                                       aria-controls="seo" aria-selected="false">SEO Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#other"
                                       role="tab"
                                       aria-controls="other" aria-selected="false">Others</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 mb-3" id="myTabContent">
                                <div class="tab-pane fade d-none " id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="form-group">
                                        <label for="cat_theme">Category Theme</label>
                                        <div class="form-check d-inline-block">
                                            <label class="radio-inline">
                                                <input type="radio" name="cat_theme"
                                                       value="1" {{(isset($term) && $term->cat_theme == 1) || !isset($term->cat_theme) ? 'checked':''}}>
                                                Theme 1
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="cat_theme"
                                                       value="2" {{isset($term) && $term->cat_theme == 2 ? 'checked':''}}>
                                                Theme 2
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="cat_theme"
                                                       value="3" {{isset($term) && $term->cat_theme == 3 ? 'checked':''}}>
                                                Theme 3
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="cat_theme"
                                                       value="4" {{isset($term) && $term->cat_theme == 4 ? 'checked':''}}>
                                                Theme 4
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('sub_menu_width', 'Sub Menu Width', array('class' => 'sub_menu_width')) }}
                                        {{ Form::text('sub_menu_width', (!empty($term->sub_menu_width) ? $term->sub_menu_width : NULL), ['id' => 'sub_menu_width', 'class' => 'form-control', 'placeholder' => 'Enter sub menu width...']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('column_count', 'How many Columns', array('class' => 'column_count')) }}
                                        {{ Form::number('column_count', (!empty($term->column_count) ? $term->column_count : NULL), ['id' => 'column_count', 'max' => 6, 'class' => 'form-control', 'placeholder' => 'Enter column count...']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('with_sub_menu', 'With sub menu', array('class' => 'with_sub_menu')) }}
                                        <select name="with_sub_menu" class="form-control">
                                            @if(!empty($term))
                                                <?php $val = (int)$term->with_sub_menu; ?>
                                                <option value="0">Select sub menu</option>
                                                <option
                                                    value="1" {!! ($val==1) ? 'selected="selected"' : null !!}>
                                                    Yes
                                                </option>
                                                <option
                                                    value="0" {!! ($val==0) ? 'selected="selected"' : null !!}>
                                                    No
                                                </option>
                                            @else
                                                <option value="0">Select sub menu</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="details" role="tabpanel"
                                     aria-labelledby="details-tab">
                                    @if(!empty($term->which_editor) && $term->which_editor == 'grapes')
                                        <div class="form-group mb-2 text-center d-block"
                                             style="padding: 30px;border: 1px dashed #ddd;background: #f9f9f9;">
                                            <a href="{{ route('common_term_edit', $term->id) }}?which_editor=grapes"
                                               class="btn btn-xl btn-success">
                                                Description edit with grapes
                                            </a>
                                        </div>
                                    @else
                                        <div class="form-group mb-2">
                                            {{ Form::label('term_content', 'Term Content', array('class' => 'term_content')) }}
                                            @if(!empty($term) && $term->with_sub_menu == 1)
                                                <a href="javascript:void(0)" class="btn btn-success pull-right"
                                                   id="btn-term-menu-generator" data-toggle="modal"
                                                   data-target="#menu-generator-modal">Menu Generator</a>
                                            @endif
                                            {{ Form::textarea('term_content', (!empty($term->description) ? $term->description : NULL), ['class' => 'form-control', 'id' => 'wysiwyg', 'placeholder' => 'Enter term content...', 'rows' => 10]) }}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::label('term_short_description', 'Short Description', array('class' => 'term_short_description')) }}
                                        {{ Form::textarea('term_short_description', (!empty($term->term_short_description) ? $term->term_short_description : NULL), ['rows' => 2, 'class' => 'form-control', 'placeholder' => 'Enter Short description...']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('term_css_class', 'Term CSS Class', array('class' => 'term_css_class')) }}
                                        {{ Form::text('term_css_class', (!empty($term->cssclass) ? $term->cssclass : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'Enter term css class. Use space for multiple class...']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('term_css_id', 'Term CSS ID', array('class' => 'term_id')) }}
                                        {{ Form::text('term_css_id', (!empty($term->cssid) ? $term->cssid : NULL), ['class' => 'form-control', 'placeholder' => 'Enter term css id...']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('term_menu_arrow', 'Term Menu Arrow', array('class' => 'term_menu_arrow')) }}
                                        {{ Form::text('term_menu_arrow', (!empty($term->term_menu_arrow) ? $term->term_menu_arrow : NULL), ['class' => 'form-control', 'placeholder' => 'Enter term menu arrow...']) }}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="urls" role="tabpanel" aria-labelledby="urls-tab">

                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'term_menu_icon',
                                                'label' => 'Term Menu Icon',
                                                'input_name' => 'term_menu_icon',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => TRUE
                                                ]])
                                        @endcomponent
                                    </div>


                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'page_image',
                                                'label' => 'Term Page Image',
                                                'input_name' => 'page_image',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => FALSE
                                                ]])
                                        @endcomponent
                                    </div>

                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'thumb_image',
                                                'label' => 'Term Thumb Image',
                                                'input_name' => 'thumb_image',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => FALSE
                                                ]])
                                        @endcomponent
                                    </div>


                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'home_image',
                                                'label' => 'Term Home Image',
                                                'input_name' => 'home_image',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => FALSE
                                                ]])
                                        @endcomponent
                                    </div>

                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'banner1',
                                                'label' => 'Term Banner One',
                                                'input_name' => 'banner1',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => FALSE
                                                ]])
                                        @endcomponent
                                    </div>

                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'banner2',
                                                'label' => 'Term Banner Two',
                                                'input_name' => 'banner2',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => FALSE
                                                ]])
                                        @endcomponent
                                    </div>

                                    <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                        @component('components.media_manager_template', [ 'media_array' => [
                                                'button_id' => 'onpage_banner',
                                                'label' => 'Term Banner Three',
                                                'input_name' => 'onpage_banner',
                                                'row_information' => $term ?? NULL,
                                                'script_load' => FALSE
                                                ]])
                                        @endcomponent
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                    @php
                                        $seoHelperParam = [
                                            'form' => false,
                                            'save_btn' => false,
                                            'required' => false,
                                            'content_id' => !empty($term) ? $term->id : null,
                                            'update_row_id_name' => 'seo_information_row_id',
                                        ];
                                        echo \App\Helpers\SeoInformationForm::getForm('Term', $seoHelperParam);
                                    @endphp
                                    <?php /*
                                        <div class="form-group">
                                            {{ Form::label('term_seo_title', 'SEO Title', array('class' => 'term_seo_title')) }}
                                            {{ Form::text('term_seo_title', (!empty($term->term_seo_title) ? $term->term_seo_title : NULL), ['class' => 'form-control', 'placeholder' => 'Product SEO Title...']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('term_seo_description', 'SEO Description', array('class' => 'term_seo_description')) }}
                                            {{ Form::textarea('term_seo_description', (!empty($term->term_seo_description) ? $term->term_seo_description : NULL), ['rows' => 2, 'class' => 'form-control', 'placeholder' => 'Enter SEO description...']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('term_seo_keywords', 'SEO Keywords', array('class' => 'term_seo_keywords')) }}
                                            {{ Form::textarea('term_seo_keywords', (!empty($term->term_seo_keywords) ? $term->term_seo_keywords : NULL), ['rows' => 2, 'class' => 'form-control', 'placeholder' => 'Enter SEO keywords...']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('term_seo_h1', 'H1 for your product page', array('class' => 'term_seo_h1')) }}
                                            {{ Form::text('term_seo_h1', (!empty($term->term_seo_h1) ? $term->term_seo_h1 : NULL), ['class' => 'form-control', 'placeholder' => 'Product page H1...']) }}
                                        </div>

                                        <div class="form-group">
                                            {{ Form::label('term_seo_h2', 'H2 for your product page', array('class' => 'term_seo_h2')) }}
                                            {{ Form::text('term_seo_h2', (!empty($term->term_seo_h2) ? $term->term_seo_h2 : NULL), ['class' => 'form-control', 'placeholder' => 'Product page H2...']) }}
                                        </div>
                                        */ ?>
                                </div>
                                <div class="tab-pane fade" id="other" role="tabpanel"
                                     aria-labelledby="other-tab">
                                    <div class="form-group">
                                        {{ Form::label('level_no', 'Term Level (Auto Generatable)', array('class' => 'level_no')) }}
                                        {{ Form::text('level_no', (!empty($term->level_no) ? $term->level_no : ''), ['id' => 'level_no_set', 'class' => 'form-control', 'readonly' => 'readonly']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('term_type', 'Term Type', array('class' => 'term_type')) }}
                                        {{ Form::select('term_type', ['category' => 'Category', 'service_category' => 'Service Category', 'others' => 'Others'], (!empty($term->type) ? $term->type : NULL), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        @endslot
                    @endcomponent
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <h6>
                            <div class="title-with-border ps-3">
                                Categories
                                <div class="d-inline-block float-end valign-text-bottom me-2">
                                    <a href="{{ route('common_term_index') }}">
                                        <span class="icon-plus"></span>
                                    </a>
                                </div>
                            </div>
                        </h6>
                        <div class="card-body" style="max-height: 600px; overflow-y: auto; font-size: 14px;">
                            <div class="input-group input-group-sm">
                                <input type="text" id="term_available_search" name="table_search"
                                       class="form-control pull-right" placeholder="Search Term">
                            </div>
                            {!! select_option_html($cats, $parent = 0, ' ', (!empty($term->parent) ? $term->parent : NULL), TRUE ) !!}

                            <div class="box-footer clearfix">
                                {{--{{ $terms->links('components.paginator', ['object' => $terms]) }}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @if(!empty($term) && $term->with_sub_menu == 1)
            <!-- Menu Generator Modal -->
                <div class="modal fade" id="menu-generator-modal" tabindex="-1" role="dialog"
                     aria-labelledby="menuGeneratorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <strong>
                                    Custom Designed Menu Generator
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"
                                                id="menu-generator-close">Close
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary" id="menu-generator-done">
                                            Done
                                        </button>
                                    </div>
                                </strong>
                            </div>
                            <div class="modal-body">

                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab">Links</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-9 menu-generator-content">
                                                    @if(!empty($term->description))
                                                        {!!html_entity_decode($term->description)!!}
                                                    @else
                                                        <div class="sub-menu-list">
                                                            <div class="sub-menu-content"
                                                                 style="border:1px solid #dfe1e6;">

                                                                <?php $menu_column_count = !empty($term->column_count) ? $term->column_count : 1; ?>
                                                                @for ($i = 0; $i < $menu_column_count; $i++)
                                                                    <ul class="sub-menu-content-list menu-generator-space">
                                                                    </ul>
                                                                @endfor
                                                            </div>
                                                            <div class="sub-menu-feature">
                                                            </div>
                                                        </div>
                                                        <div class="sub-menu-thumb">
                                                            <ul>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="col-md-2 available-menu">

                                                    <div class="box box-success" style="border: 1px solid green;">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Available Menu</h3>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            {{ get_dynamic_category($term->id,1) }}
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>

                                                </div>

                                                <div class="col-sm-3 col-md-2 menu-generator-tool pull-right">

                                                    <div class="box box-success" style="border: 1px solid green;">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Menu Links Configuration</h3>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="form-box">
                                                                <div class="form-group">
                                                                    <label>How many columns</label>
                                                                    <input type="number" id="menu-generator-column"
                                                                           class="form-control input-sm"
                                                                           style="max-width: 80px;" max="8">
                                                                </div>
                                                                <fieldset>
                                                                    <legend>Add or Edit Links</legend>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="menu-generator-cat-name">Name:</label>
                                                                        <input type="text" id="menu-generator-cat-name"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="menu-generator-cat-link">Link:</label>
                                                                        <input type="text" id="menu-generator-cat-link"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <button type="button" id="menu-generator-cat-submit"
                                                                            class="btn btn-sm btn-success">
                                                                        Save Changes
                                                                    </button>
                                                                    <small>Click on link from left listed links</small>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <div class="box box-success" style="border: 1px solid green;">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Slot Configuration</h3>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="form-box">
                                                                <div id="slot-delete-clear" style="display: none">
                                                                    <a href="javascript:void(0)"
                                                                       class="btn-xs btn-primary"
                                                                       id="slot-clear">Clear</a>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn-xs btn-danger" id="slot-delete">Delete
                                                                        Slot</a>
                                                                </div>
                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        <label for="slot-title">Title:</label>
                                                                        <input type="text" id="slot-title"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="slot-title">Link:</label>
                                                                        <input type="text" id="slot-link"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="slot-image-link">Image Link:</label>
                                                                        <input type="text" id="slot-image-link"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <button type="button" id="submit-slot"
                                                                            class="btn btn-sm btn-success">
                                                                        Save Changes
                                                                    </button>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <div class="box box-success" style="border: 1px solid green;">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Brands Configuration</h3>
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="form-box">

                                                                <div id="brands-delete-clear" style="display: none">
                                                                    <a href="javascript:void(0)"
                                                                       class="btn-xs btn-primary" id="brands-clear">Clear</a>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn-xs btn-danger" id="brands-delete">Delete
                                                                        Brand</a>
                                                                </div>

                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        <label for="brands-link">Link:</label>
                                                                        <input type="text" id="brands-link"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="brands-image-link">Image
                                                                            Link:</label>
                                                                        <input type="text" id="brands-image-link"
                                                                               class="form-control input-sm">
                                                                    </div>
                                                                    <button type="button" id="submit-brands"
                                                                            class="btn btn-sm btn-success">
                                                                        Save Changes
                                                                    </button>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
@endsection


@section('cusjs')
    @if(request()->get('which_editor') == 'grapes')
        @include('components.grapesjs')

        <script type="text/javascript">
            let storeUrl = "{{ route('common_term_grapes_update') }}?id={{ $term->id ?? null }}";
            let loadUrl = "{{ route('common_term_grapes_load_now') }}?id={{ $term->id ?? null }}";
            grapesLoader(storeUrl, loadUrl);
        </script>
    @endif

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        jQuery(document).ready(function ($) {
            $("#term_available_search").keyup(function () {
                const termInput = this.value.toLowerCase()
                $(".availeable-term-category ul li").each(function (i, v) {
                    let ele = $(v),
                        text = $(v).text().replace(/\s+/g, ' ').trim().toLowerCase(),
                        match = text.indexOf(termInput);
                    match > -1 ? ele.show() : ele.hide()
                })
            })

        })
    </script>

    <script>
        <?php if (!empty($term->id)) { ?>
        <?php } else { ?>
        jQuery(document).ready(function ($) {
            $.noConflict();
            /**
             $('#level_no_get').on('change', function() {
                                alert(32423);
                            });
             */
            $('#term_name').blur(function () {
                var m = $(this).val();
                var cute1 = m.toLowerCase().replace(/ /g, '-').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
                var cute = cute1.replace(/[`~!@#$%^&*()_|+\=?;:'"”,.<>\{\}\[\]\\\/]/gi, '');

                $('#term_css_class, #term_css_id, #seo_url').val(cute);
            });
            $('#term_name').blur(function () {
                var seo_url = $('#seo_url').val();
                var type = $('#seo_url').data('type');
                if (type == 'create') {
                    var data = {
                        'seo_url': seo_url
                    };
                    //console.log(data);
                    jQuery.ajax({
                        url: baseurl + '/check_if_cat_url_exists',
                        method: 'get',
                        data: data,
                        success: function (data) {
                            $('#seo_url').val(data.url);
                        },
                        error: function () {
                            // showError('Sorry. Try reload this page and try again.');
                            // processing.hide();
                        }
                    });
                }

            });
        });
        <?php } ?>


        /*Menu Generator Modal */
        jQuery(document).ready(function ($) {
            let currentColumnCount = getAvailableColumnCount(),
                editingEle,
                slotSelectedEle,
                brandSelectedEle;
            console.log(matching())
            $('body').on('click', '#btn-term-menu-generator', function () {
                setCurrentColumnInput(currentColumnCount)
                sortableEnable();
            })
            $('body').on('change', '#menu-generator-column', function () {
                addNewColumn(this.value)
                sortableEnable();
            })
            $('body').on('click', '.menu-generator-cat-remove', function () {
                $(this.parentElement).remove()
            })
            $('body').on('click', '.modal-body ul li a', function (e) {
                e.preventDefault();
                editingEle = this
                $("#menu-generator-cat-name").val(this.firstChild.data)
                $("#menu-generator-cat-link").val(this.href)
            })
            $('body').on('click', '#menu-generator-cat-submit', function () {
                let cat_name = $("#menu-generator-cat-name"),
                    cat_link = $("#menu-generator-cat-link"),
                    orAdd;
                if (editingEle) {
                    editingEle.href = cat_link.val()
                    editingEle.firstChild.data = cat_name.val()
                    editingEle = ''
                } else {
                    orAdd = `<li><a href="${cat_link.val()}">${cat_name.val()}</a></li>`
                    $(".available-menu .sub-menu-content-list").append(orAdd)
                }
                cat_name.val(``)
                cat_link.val(``)
            })
            $('body').on('click', '#menu-generator-done', function () {
                sortableDisable()
                const content = $("#menu-generator-modal .modal-body .menu-generator-content").html(),
                    data = proccessContent(content)
                $("#wysiwyg").trumbowyg('html', data);
                $("#column_count").val($("#menu-generator-column").val());
                $("#menu-generator-modal").modal('toggle');
            })
            $('body').on('click', '#menu-generator-close', function () {
                sortableDisable()
            })
            $('body').on('click', '.sub-menu-feature a.sub-menu-feature-content', function (e) {
                e.preventDefault()
                slotSelectedEle = this
                $("#slot-title").val($(this.children[0].children[0]).text())
                $("#slot-link").val(this.href)
                $("#slot-image-link").val($(this.children[1].children[0]).attr('src'))

                $("#slot-delete-clear").css('display', '')

            })
            $('body').on('click', '#submit-slot', function () {
                if ($("#slot-title").val()) {
                    if (slotSelectedEle) {
                        slotSelectedEle.href = $("#slot-link").val()
                        $(slotSelectedEle.children[0].children[0]).text($("#slot-title").val())
                        $(slotSelectedEle.children[1].children[0]).attr('src', $("#slot-image-link").val())
                        slotSelectedEle = false
                    } else {
                        const html = `<a class="sub-menu-feature-content" href="${$("#slot-link").val()}"><div class="sub-menu-feature1-text"> <p>${$("#slot-title").val()}</p> </div> <div class="sub-menu-feature1-thumb"><img src="${$("#slot-image-link").val()}" alt=""></div></a>`
                        $(".sub-menu-feature").append(html)
                    }
                }
                $("#slot-title").val('')
                $("#slot-link").val('')
                $("#slot-image-link").val('')
                $("#slot-delete-clear").css('display', 'none')
            })
            $("body").on('click', '#slot-delete', function () {
                if (slotSelectedEle) {
                    $(slotSelectedEle).remove()
                    $("#slot-title").val('')
                    $("#slot-link").val('')
                    $("#slot-image-link").val('')
                    $("#slot-delete-clear").css('display', 'none')
                    slotSelectedEle = false
                }
            })
            $("body").on('click', '#slot-clear', function () {
                $("#slot-title").val('')
                $("#slot-link").val('')
                $("#slot-image-link").val('')
                $("#slot-delete-clear").css('display', 'none')
                slotSelectedEle = false
            })
            $("body").on('click', '.sub-menu-thumb ul li', function () {
                brandSelectedEle = this
                $("#brands-link").val(this.children[0].href)
                $("#brands-image-link").val($(this.children[0].children[0]).attr('src'))

                $("#brands-delete-clear").css('display', '')
            })
            $('body').on('click', '#submit-brands', function () {
                if ($("#brands-link").val()) {
                    if (brandSelectedEle) {
                        brandSelectedEle.children[0].href = $("#brands-link").val()
                        $(brandSelectedEle.children[0].children[0]).attr('src', $("#brands-image-link").val())
                        brandSelectedEle = false
                    } else {
                        const html = `<li> <a href="${$("#brands-link").val()}"><img src="${$("#brands-image-link").val()}" alt=""></a> </li>`
                        $(".sub-menu-thumb ul").append(html)
                    }
                }
                $("#brands-link").val('')
                $("#brands-image-link").val('')
                $("#brands-delete-clear").css('display', 'none')
                brandSelectedEle = false
            })
            $("body").on('click', '#brands-delete', function () {
                if (brandSelectedEle) {
                    $(brandSelectedEle).remove()
                    $("#brands-link").val('')
                    $("#brands-image-link").val('')
                    $("#brands-delete-clear").css('display', 'none')
                    brandSelectedEle = false
                }
            })
            $("body").on('click', '#brands-clear', function () {
                $("#brands-link").val('')
                $("#brands-image-link").val('')
                $("#brands-delete-clear").css('display', 'none')
                brandSelectedEle = false
            })

            function getAvailableColumnCount() {
                let columnCount = $(".menu-generator-content .sub-menu-content").children().length
                return columnCount
            }

            function setCurrentColumnInput(count) {
                let column = $("#menu-generator-column")
                column.prop('min', emptyOrData()[1].length)
                column.val(count)
                return
            }

            function addNewColumn(n) {
                let aCount = getAvailableColumnCount(),
                    columnSelector = $(".menu-generator-content .sub-menu-content")

                if (aCount < n) {
                    const html = `<ul class="sub-menu-content-list menu-generator-space">
                        </ul>`;

                    columnSelector.append(html)
                    setCurrentColumnInput(aCount + 1)
                } else if (aCount > n) {
                    let emptyOrDat = emptyOrData(),
                        emptyCol = emptyOrDat[0],
                        dataCol = emptyOrDat[1];


                    let rCol = aCount - n,
                        rDone = 0;
                    $.each(emptyCol, function (i, v) {
                        if (rCol > rDone) {
                            $(v).remove()
                        }
                        rDone++;
                    })
                }
            }

            function sortableEnable() {
                $(".menu-generator-space").sortable({
                    connectWith: ".menu-generator-space",
                    placeholder: "ui-state-highlight",
                    tolerance: 'intersect',
                    receive: function () {
                        $("#menu-generator-column").prop('min', emptyOrData()[1].length)
                    }
                });
                $(".menu-generator-space").sortable("option", "disabled", false);
                $(".menu-generator-space").disableSelection();
                return false;
            }

            function sortableDisable() {
                $(".menu-generator-space").sortable("disable");
                return false;
            }

            function emptyOrData() {
                let emptyCol = [],
                    dataCol = [];
                $.each($(".menu-generator-content .sub-menu-content").children(), function (i, s) {
                    ($(s).children().length > 0) ?
                        dataCol.push(s) : emptyCol.push(s)
                })
                return [emptyCol, dataCol]
            }

            function proccessContent(content) {
                let data = content.replace(/ class="ui-sortable-handle"/g, '')
                data = data.replace(/ui-sortable/g, '')
                data = data.replace(/-disabled/g, '')
                data = data.replace(/border:1px solid #dfe1e6;/g, '')
                /*data = data.replace(/ style="border: 1px solid #dfe1e6"/g,'')*/
                data = data.replace(/\s+/g, ' ').trim()
                return data
            }

            function matching() {
                let manageData = $(".menu-generator-content ul li a"),
                    unManageData = $(".available-menu ul li a"),
                    fullUnAvail = $(".available-menu ul ul"),
                    nManage = {}
                $.each(manageData, function (i, s) {
                    nManage[s.href] = s
                })
                $.each(unManageData, function (i, s) {
                    if (nManage[s.href]) {
                        $(s.parentElement).remove()
                    }
                })
                $.each(fullUnAvail, function (i, s) {
                    if (!($(s).children().length > 0) && $(s).parent().children().length === 1) {
                        $(s).parent().remove()
                    }
                })
                return true;
            }
        });
    </script>
    <style type="text/css">
        ul.on_terms {
            margin: 0;
            padding-left: 20px;
        }

        ul.on_terms li {
            border: 1px solid #EEE;
            margin: 2px;
            padding: 3px;
            border-right: 0;
            border-top: 0;
            border-left: 0;
        }


        .sub-menu-content {
            display: flex !important;
            justify-content: space-around !important;
            padding-top: 5px;
        }

        .modal-dialog {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            height: auto;
            min-height: 100%;
            border-radius: 0;
        }

        .menu-generator-cat-remove {
            height: 50px;
            width: 50px;
            position: absolute;

        }

        .menu-generator-content .menu-generator-space,
        .available-menu ul {
            min-height: 80px;
            min-width: 120px;
        }

        .menu-generator-content .sub-menu-content-list {
            border: 1px solid #dfe1e6;
        }

        .sub-menu-content-list li {
            margin-left: -15px;
            padding-right: 8px;
        }

        .menu-generator-cat-remove {
            position: relative;
            left: -22px;
            color: black;
        }

        .menu-generator-link-remove {
            position: relative;
            color: black;
            left: -22px;

        }

        .sub-menu-feature {
            border: 1px solid green;
            padding: 10px;
            margin-bottom: 20px;
        }

        .sub-menu-feature::before {
            content: "Slots -";
            font-weight: 900;
        }

        .sub-menu-feature .sub-menu-feature-content {
            border: 1px solid #ddd;
            margin: 1px;
            padding: 5px;
            display: inline-block;
            width: 32% !important;
            min-height: 150px;
        }

        .sub-menu-feature1-thumb img {
            max-width: 80px;
        }

        .sub-menu-thumb {
            border: 1px solid green;
            padding: 10px;
            width: 500px;
        }

        .sub-menu-thumb ul {
            column-count: 2;
            text-align: left;
            margin: 0;
            padding: 0;
        }

        .sub-menu-thumb li {
            list-style: none;
            margin: 2px;
            padding: 10px 0 5px 0px;
            border: 1px solid #DDDDDD;
            text-align: center;
        }

        .sub-menu-thumb li a > img {
            max-width: 80px;
        }

        .sub-menu-thumb::before {
            content: "Brands -";
            font-weight: 900;
        }

        span.badge {
            padding: 0 0 0 5px;
        }
    </style>
@endsection
