@extends('admin.layouts.master')

@section('title')
    Calculator Basic Settings of {{ $Model('Term')::getColumn(request()->id, 'name') }}
@endsection
@section('filter')
    @if(request()->id)
        <a href="{{ route('common_term_edit', request()->id) }}" class="btn btn-sm btn-success py-0">Back</a>
    @endif
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-5" id="signupForm">
                @if(request()->get('basic_setting_input_type'))
                    @include('admin.common.terms.calculator.input_type_form')
                @else
                    @component('components.form')
                        @slot('title')
                            @if (!empty($setting->id))
                                Edit setting
                            @else
                                Add a setting
                            @endif
                        @endslot
                        @slot('route')
                            @if (!empty($setting->id))
                                {{ route('calculator_setting_update') }}
                            @else
                                {{ route('calculator_setting_store') }}
                            @endif
                        @endslot
                        @slot('fields')
                            {{ Form::hidden('service_id', (!empty(request()->id) ? request()->id : NULL), ['type' => 'hidden']) }}
                            {{ Form::hidden('which_module', 'Basic', ['type' => 'hidden']) }}
                            @if (!empty(request()->get('section_id')))
                                {{ Form::hidden('calc_basic_setting_id', request()->get('section_id'), ['type' => 'hidden']) }}
                            @endif
                            {{ Form::hidden('service_slug', $Model('Term')::getColumn(request()->id, 'seo_url') ?? NULL, ['type' => 'hidden']) }}
                            <div class="form-group">
                                {{ Form::label('setting_type', 'Setting Type', array('class' => 'setting_type')) }}
                                @php
                                    $calculator_setting_option = $Model('AttributeValue')::getValues('Calculator Setting');
                                @endphp
                                <select class="form-select" name="setting_type">
                                    <option>Select setting type</option>
                                    @foreach ($calculator_setting_option as $index => $option)
                                        <option value="{{ $option->id ?? NULL }}"
                                            {{ !empty($setting) && $setting->setting_type == $option->id ? 'selected' : '' }}>
                                            {{ $option->value ?? NULL }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('setting_title', 'Title', array('class' => 'setting_title')) }}
                                {{ Form::text('setting_title', (!empty($setting->setting_title) ? $setting->setting_title : old('setting_title')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter title...']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('setting_sub_title', 'Sub Title', array('class' => 'setting_sub_title')) }}
                                {{ Form::text('setting_sub_title', (!empty($setting->setting_sub_title) ? $setting->setting_sub_title : old('setting_sub_title')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter sub title...']) }}
                            </div>
                            {{--                        <div class="form-group">--}}
                            {{--                            {{ Form::label('service_icon', 'Service Icon', array('class' => 'service_icon')) }}--}}
                            {{--                            {{ Form::text('service_icon', (!empty($setting->service_icon) ? $setting->service_icon : old('service_icon')), ['class' => 'form-control', 'placeholder' => 'Enter service icon...']) }}--}}
                            {{--                        </div>--}}

                            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                                @component('components.media_manager_template', [ 'media_array' => [
                                        'button_id' => 'service_icon',
                                        'label' => 'Service Icon',
                                        'input_name' => 'service_icon',
                                        'row_information' => $setting ?? NULL,
                                        'script_load' => TRUE
                                        ]])
                                @endcomponent
                            </div>


                            <div class="form-group">
                                {{ Form::label('equation_type', 'Equation Type', array('class' => 'equation_type')) }}
                                @php
                                    $equation_type = $Model('AttributeValue')::getValues('Equation Type');
                                @endphp
                                <select class="form-select" name="equation_type">
                                    <option>Select equation type</option>
                                    @foreach ($equation_type as $index => $option)
                                        <option value="{{ $option->id ?? NULL }}"
                                            {{ !empty($setting) && $setting->equation_type == $option->id ? 'selected' : '' }}>
                                            {{ $option->value ?? NULL }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('rate', 'Rate', array('class' => 'rate')) }}
                                {{ Form::text('rate', $setting->rate ?? 0, ['required', 'class' => 'form-control', 'placeholder' => 'Enter rate...']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('show_on_calculator', 'Show on calculator', array('class' => 'show_on_calculator')) }}
                                <div class="form-check d-inline-block">
                                    <label class="radio-inline d-block">
                                        {{ Form::radio('show_on_calculator', 'Yes', (!empty($setting) ? (($setting->show_on_calculator == 'Yes') ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                        Yes
                                    </label>
                                    <label class="radio-inline  d-block">
                                        {{ Form::radio('show_on_calculator', 'No', (!empty($setting) ? (($setting->show_on_calculator == 'No') ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('computable', 'Computable', array('class' => 'computable')) }}
                                <div class="form-check d-inline-block">
                                    <label class="radio-inline d-block">
                                        {{ Form::radio('computable', 'Yes', (!empty($setting) ? (($setting->computable == 'Yes') ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                                        Yes
                                    </label>
                                    <label class="radio-inline  d-block">
                                        {{ Form::radio('computable', 'No', (!empty($setting) ? (($setting->computable == 'No') ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                                        No
                                    </label>
                                </div>
                            </div>



                            <div class="form-group">
                                {{ Form::label('intial_selected', 'Intial Selected', array('class' => 'intial_selected')) }}
                                <div class="form-check d-inline-block">

                                    <label class="radio-inline d-block">
{{--                                        {{ Form::radio('intial_selected', 'Yes', (!empty($setting) ? (($setting->intial_selected == 'Yes') ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}--}}
                                        <input type="radio"
                                               class = "radio"
                                               {{!empty($setting) && $setting->intial_selected == 'Yes' ? 'checked' : null}}
                                               value="Yes"
                                               name="intial_selected" id="intial_selected">
                                        Yes
                                    </label>
                                    <label class="radio-inline d-block">
{{--                                        {{ Form::radio('intial_selected', 'No', (!empty($setting) ? (($setting->intial_selected == 'No') ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}--}}
                                        <input type="radio"
                                               class = "radio"
                                                @if(!empty($setting))
                                                   {{!empty($setting) && $setting->intial_selected == 'No' ? 'checked' : null}}
                                                   {{!empty($setting) && $setting->intial_selected == null ? 'checked' : null}}
                                                @else
                                                    checked
                                                @endif
                                               value="No"
                                               name="intial_selected" id="intial_selected">
                                        No
                                    </label>

                                    <small>If you select this then other options of this setting will be automatically
                                        deselect.</small>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('calculate_with', 'Calculate With', array('class' => 'calculate_with')) }}
                                <div class="form-check d-inline-block">
                                    <label class="radio-inline d-block">
                                        {{ Form::radio('calculate_with', 'Before Total', (!empty($setting) && $setting->calculate_with == 'Before Total') ?? NULL, ['class' => 'radio']) }}
                                        Before Total
                                    </label>
                                    <label class="radio-inline  d-block">
                                        {{ Form::radio('calculate_with', 'After Total', (!empty($setting) && $setting->calculate_with == 'After Total') ?? NULL, ['class' => 'radio']) }}
                                        After Total
                                    </label>
                                </div>

                            </div>

                        @endslot
                    @endcomponent
                @endif
            </div>
            <div class="col-md-7 table-wrapperx desktop-view mobile-view">
                @component('components.boxcard')
                    @slot('title')
                        List basic setting of {{ $Model('Term')::getColumn(request()->id, 'name') }}
                        <div class="d-inline-block float-end valign-text-bottom me-2">
                            <a href="{{ route('calculator_setting_index', request()->id) }}">
                                <span class="icon-plus"></span>
                            </a>
                        </div>
                    @endslot
                    @slot('fields')
                        <div id="reload_me">
                            <table class="table table-bordered table-non-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Equation Type</th>
                                    <th class="text-center">Rate</th>
                                    <th class="text-center">Initial Selected</th>
                                    <th class="text-center">Calculate With</th>
                                    <th class="text-center">Show on calc</th>
                                    <th class="text-center">Computable</th>
                                </tr>
                                </thead>

                                <tbody id="sortable">
                                @php
                                    $contents = $Model('CalcBasicSetting')::where('service_id', request()->id)->orderBy('sorting_order', 'asc')->groupBy('setting_type')->get();
                                @endphp

                                @if(count($contents) > 0)
                                    @foreach($contents as $key => $value)
                                        @php
                                            $success = ' border-top bg-light';
                                        @endphp
                                        <tr>

                                            <td colspan="7">
                                                <img
                                                    src="{{ $Media::iconSize($Model('CalcInputType')::getInputEle($value->setting_type, $value->service_id)->input_icon ?? NULL) }}"
                                                width="30px" />
                                                <strong>
                                                    {{ $Model('AttributeValue')::getValueById($value->setting_type) }}
                                                </strong>
                                                @if($inputType = $Model('CalcInputType')::getByAttrId($value->setting_type, ['service_id' => request()->id]))
                                                    (
                                                    Input Type: {{ $inputType }}             -
                                                    Design: {{ $Model('CalcInputType')::getDesignByAttrId($value->setting_type, ['service_id'=> request()->id]) }}
                                                    )
                                                @endif

                                                <a class="d-block xaddInputType py-0 float-end"
                                                   xid="addInputType"
                                                   xdata-attrid="{{ $value->setting_type ?? NULL }}"
                                                   xdata-serviceid="{{ request()->id }}"
                                                   xtype="button"
                                                   href="{{route('calculator_setting_index', request()->id)}}/?basic_setting_input_type={{ $Model('CalcInputType')::where('attr_id', $value->setting_type)->first()->id ?? 'new' }}&attr_id={{ $value->setting_type }}">
                                                    <i class="icon-plus-circle text-primary"></i>
                                                    Input Type
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $subContents = $Query::accessModel('CalcBasicSetting')::where('service_id', request()->id)
                                                            ->where('setting_type', $value->setting_type)
                                                            ->where(function($q) {
                                                                $q->where('which_module', 'Basic')->orWhereNull('which_module');
                                                            })
                                                            ->orderBy('sorting_order', 'asc')->get();
                                        @endphp
                                        @if(count($subContents) > 0)
                                            @foreach($subContents as $key => $subValue)
                                                <tr style="cursor: move;" id="item-{{ $subValue->id }}"
                                                    class="{{ $subValue->id == request()->get('section_id') ? $success : null }}">
                                                    <td class="text-center">
                                                        {!! $ButtonSet::delete('calculator_setting_destroy', $subValue->id) !!}
                                                        <a class="d-inline-block py-0"
                                                           href="{{ route('calculator_setting_edit', [request()->id]) }}?section_id={{ $subValue->id }}">
                                                            <i class="icon-edit text-primary"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $subValue->setting_title ?? NULL }}</td>
                                                    <td>{{ $Model('AttributeValue')::getValueById($subValue->equation_type) }}</td>
                                                    <td class="text-center">{{ $subValue->rate ?? NULL }}</td>
                                                    <td class="text-center">{{ $subValue->intial_selected == 'Yes' ? 'Yes'  :  'No' }}</td>
                                                    <td class="text-center">{{ $subValue->calculate_with ?? NULL }}</td>
                                                    <td class="text-center">{{ $subValue->show_on_calculator ?? NULL }}</td>
                                                    <td class="text-center">{{ $subValue->computable ?? NULL }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    <li class="list-group-item">
                                        You have not created any list for this section yet.
                                    </li>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('cusjs')
    {!! $Component::bootstrapModal('addInputType', [
        'backdrop' => true,
        'saveBtn' => 'Save',
        'formAction' => route('calculator_input_setting_store'),
        'modalHeader' => 'Input Type Configuration']) !!}

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();
            $('#sortable').sortable({
                axis: 'y',
                cursor: 'move',
                update: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: data,
                        type: 'POST',
                        headers: {
                            'X-CSRF-Token': "{{ csrf_token() }}"
                        },
                        url: "{{ route('calculator_setting_list_sorting') }}?id={{ request()->id }}",
                        success: function (output) {
                            //alert(output.message);
                            toastr.success(output.message);
                            jQuery(window).load(function () {
                                $("div#reload_me").load(window.location.assign(href) + " div#reload_me");
                                //location.reload();
                            });
                        }
                    });
                }
            });

            $('.addInputType').on('click', function (e) {
                e.preventDefault();
                let attrid = $(this).data('attrid');
                let serviceid = $(this).data('serviceid');

                let htmls = `<div class="content-wrapper" id="changeIt">
                <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                {{ Form::label('input_type', 'Input Type', array('class' => 'input_type')) }}
                @php
                    $input_type = $Model('AttributeValue')::getValues('Input Type');
                @endphp
                <select class="form-select" name="input_type" required="required">
                        <option>Select Input type</option>
                        @foreach ($input_type as $index => $option)
                <option value="{{ $option->id ?? NULL }}"
                                {{ !empty($setting) && $setting->input_type == $option->id ? 'selected' : '' }}>
                                {{ $option->value ?? NULL }}
                </option>
@endforeach
                </select>
                </div>
                <div class="form-group">
                {{ Form::label('radio_design', 'Radio Design', array('class' => 'radio_design')) }}
                @php
                    $radio_design = $Model('AttributeValue')::getValues('Radio Type');
                @endphp
                <select class="form-select" name="radio_design" required="required">
                        <option>Select Input type</option>
                        @foreach ($radio_design as $index => $option)
                <option value="{{ $option->id ?? NULL }}">
                                    {{ $option->value ?? NULL }}
                </option>
@endforeach
                </select>
                </div>


                <input name="attr_id" type="hidden" value="${attrid}"/>
                <input name="service_id" type="hidden" value="${serviceid}"/>
                </div>
                </div>
                </div>`;

                $("#addInputTypeModalBody").html(htmls);
            });
        });
    </script>
@endsection
