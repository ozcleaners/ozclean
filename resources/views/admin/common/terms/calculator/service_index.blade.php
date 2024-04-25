@extends('admin.layouts.master')

@section('title')
    Calculator Service Settings of {{ $Model('Term')::getColumn(request()->id, 'name') }}
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
                @if(!empty(request()->get('material_id')))
                    @include('admin.common.terms.calculator.material_setting_form')
                @elseif(!empty(request()->get('storey_id')))
                    @include('admin.common.terms.calculator.storey_setting_form')
                @else
                    @include('admin.common.terms.calculator.service_setting_form')
                @endif
            </div>
            <div class="col-md-7 table-wrapperx desktop-view mobile-view">
                @include('admin.common.terms.calculator.service_setting_list')
            </div>
        </div>
    </div>
@endsection

@section('cusjs')
    {!! $Component::bootstrapModal('addMaterial', ['backdrop' => true, 'saveBtn' => 'Add','formAction' => route('calculator_material_setting_store'), 'modalHeader' => 'Type of Materials']) !!}
    {!! $Component::bootstrapModal('addStorey', ['backdrop' => true, 'saveBtn' => 'Add','formAction' => route('calculator_setting_store'), 'modalHeader' => 'No of storey']) !!}
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

            $('#title_slug').blur(function () {
                var m = $(this).val();
                var cute1 = m.toLowerCase().replace(/ /g, '_').replace(/&amp;/g, 'and').replace(/&/g, 'and').replace(/ ./g, 'dec');
                var cute = cute1.replace(/[`~!@#$%^&*()|+\=?;:'"”,.<>\{\}\[\]\\\/-]/gi, '');

                $('#seo_url').val(cute);
            });

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
                        url: "{{ route('calculator_service_setting_list_sorting') }}?id={{ request()->id }}",
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

            $('.addMaterial').on('click', function (e) {
                e.preventDefault();
                let sectionid = $(this).data('sectionid');
                let serviceid = $(this).data('serviceid');

                let htmls = `<div class="content-wrapper" id="changeIt">
                <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                {{ Form::label('material_title', 'Material Title', array('class' => 'material_title')) }}
                {{ Form::text('material_title', (!empty($setting->material_title) ? $setting->material_title : old('material_title')), ['required', 'id' => 'material_title', 'class' => 'form-control', 'placeholder' => 'Enter material title...']) }}
                </div>
                <div class="form-group">
                {{ Form::label('equation_type', 'Equation Type', array('class' => 'equation_type')) }}
                @php
                    $equation_type = $Model('AttributeValue')::getValues('Equation Type');
                @endphp
                <select class="form-select" name="equation_type" required="required">
                    <option>Select equation type</option>
                @foreach ($equation_type as $index => $option)
                <option value="{{ $option->id ?? NULL }}"
                {{ !empty($setting) && $setting->equation_type == $option->id ? 'selected' : '' }}>
                {{ $option->value ?? NULL }}
                </option>
                @endforeach
                </select>
                </div>
                <div class="form-group">{{ Form::label('rate', 'Rate', array('class' => 'rate')) }}
                {{ Form::text('rate', (!empty($setting->rate) ? $setting->rate : old('rate')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter rate...']) }}
                </div>
                <div class="form-group">{{ Form::label('extras_connection', 'Extras Connection', array('class' => 'extras_connection')) }}
                <div class="form-check d-inline-block checkboxFontSize">
                @php
                    $extras = $Model('CalcServiceSetting')::where('setting_option_type', 35)
                                ->where('service_id', request()->id)
                                ->get();
                @endphp
                @foreach($extras as $extra)
                <input type="checkbox" name="extras_connection[]" value="{{ $extra->id }}" /> {{ $extra->service_title }}
                - <small>Base Price: {{ $extra->base_price ?? NULL }} </small><br/>@endforeach
                </div>
                </div>
                <input name="section_id" type="hidden" value="${sectionid}"/><input name="service_id" type="hidden" value="${serviceid}"/>
                </div></div></div>`;
                $("#addMaterialModalBody").html(htmls);
            });


            $('.addStorey').on('click', function (e) {
                e.preventDefault();
                let sectionid = $(this).data('sectionid');
                let serviceid = $(this).data('serviceid');

                let htmls = `
                <div class="content-wrapper" id="changeIt">
                <div class="row">
                <div class="col-md-12">
                {{ Form::hidden('which_module', 'Other', ['type' => 'hidden']) }}
                {{ Form::hidden('service_id', (!empty(request()->id) ? request()->id : NULL), ['type' => 'hidden']) }}
                @if (!empty(request()->get('section_id')))
                {{ Form::hidden('calc_basic_setting_id', request()->get('section_id'), ['type' => 'hidden']) }}
                @endif
                {{ Form::hidden('setting_type', 31, ['type' => 'hidden']) }}
                {{ Form::hidden('service_slug', $Model('Term')::getColumn(request()->id, 'seo_url') ?? NULL, ['type' => 'hidden']) }}
                <div class="form-group">
                {{ Form::label('setting_title', 'Title', array('class' => 'setting_title')) }}
                {{ Form::text('setting_title', (!empty($setting->setting_title) ? $setting->setting_title : old('setting_title')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter title...']) }}
                </div>
                <div class="form-group">
                {{ Form::label('service_icon', 'Service Icon', array('class' => 'service_icon')) }}
                {{ Form::text('service_icon', (!empty($setting->service_icon) ? $setting->service_icon : old('service_icon')), ['class' => 'form-control', 'placeholder' => 'Enter service icon...']) }}
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
                {{ Form::text('rate', (!empty($setting->rate) ? $setting->rate : old('rate')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter rate...']) }}
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
                </div></div></div>`;
                $("#addStoreyModalBody").html(htmls);
            });
        });


    </script>
@endsection
