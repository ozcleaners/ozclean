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
            {{ route('calculator_service_setting_update') }}
        @else
            {{ route('calculator_service_setting_store') }}
        @endif
    @endslot
    @slot('fields')
        {{ Form::hidden('service_id', (!empty(request()->id) ? request()->id : NULL), ['type' => 'hidden']) }}
        @if (!empty(request()->get('section_id')))
            {{ Form::hidden('calc_service_setting_id', request()->get('section_id'), ['type' => 'hidden']) }}
        @endif
        {{ Form::hidden('service_slug', $Model('Term')::getColumn(request()->id, 'seo_url') ?? NULL, ['type' => 'hidden']) }}
        <div class="form-group">
            {{ Form::label('setting_option_type', 'Service Category', array('class' => 'setting_option_type')) }}
            @php
                $service_type = $Model('AttributeValue')::getValues('Service Type');
            @endphp
            <select class="form-select" name="setting_option_type">
                <option>Select service category</option>
                @foreach ($service_type as $index => $option)
                    <option value="{{ $option->id ?? NULL }}"
                        {{ !empty($setting) && $setting->setting_option_type == $option->id ? 'selected' : '' }}>
                        {{ $option->value ?? NULL }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('service_title', 'Service Title', array('class' => 'service_title')) }}
            {{ Form::text('service_title', (!empty($setting->service_title) ? $setting->service_title : old('service_title')), ['required', 'id' => 'title_slug', 'class' => 'form-control', 'placeholder' => 'Enter service title...']) }}
        </div>
        <div class="form-group">
            {{ Form::label('service_sub_title', 'Sub Title', array('class' => 'service_sub_title')) }}
            {{ Form::text('service_sub_title', (!empty($setting->service_sub_title) ? $setting->service_sub_title : old('service_sub_title')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter sub title...']) }}
        </div>
        <div class="form-group">
            {{ Form::label('service_title_slug', 'Service Title Slug', array('class' => 'service_title_slug')) }}
            {{ Form::text('service_title_slug', (!empty($setting->service_title_slug) ? $setting->service_title_slug : old('service_title_slug')), ['required', 'id' => 'seo_url', 'class' => 'form-control', 'placeholder' => 'Enter service title slug...', 'readonly' => true]) }}
        </div>
        <div class="form-group">
            {{ Form::label('base_price', 'Base Price', array('class' => 'base_price')) }}
            {{ Form::text('base_price', $setting->base_price ?? 0, ['required', 'class' => 'form-control', 'placeholder' => 'Enter base price...']) }}
        </div>
        <div class="form-group">
            {{ Form::label('extra_default', 'Extra Default', array('class' => 'extra_default')) }}
            {{ Form::text('extra_default',  $setting->extra_default ?? 0, ['required', 'class' => 'form-control', 'placeholder' => 'Enter extra default...']) }}
        </div>

        {{--        <div class="form-group">--}}
        {{--            {{ Form::label('service_icon', 'Service Icon', array('class' => 'service_icon')) }}--}}
        {{--            {{ Form::text('service_icon', (!empty($setting->service_icon) ? $setting->service_icon : old('service_icon')), ['class' => 'form-control', 'placeholder' => 'Enter service icon...']) }}--}}
        {{--        </div>--}}

        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
            @component('components.media_manager_template', [ 'media_array' => [
                    'button_id' => 'images',
                    'label' => 'Service Icon',
                    'input_name' => 'service_icon',
                    'row_information' => $setting ?? NULL,
                    'script_load' => TRUE
                    ]])
            @endcomponent
        </div>
        <div class="form-group">
            {{ Form::label('minimum_qty', 'Minimum Quantity', array('class' => 'minimum_qty')) }}
            {{ Form::text('minimum_qty', $setting->minimum_qty ?? 0, ['required', 'class' => 'form-control', 'placeholder' => 'Enter minimum purchase quantity...']) }}
        </div>
        <div class="form-group">
            {{ Form::label('maximum_qty', 'Maximum Quantity', array('class' => 'maximum_qty')) }}
            {{ Form::text('maximum_qty', $setting->maximum_qty ?? 0, ['required', 'class' => 'form-control', 'placeholder' => 'Enter maximum purchase quantity...']) }}
        </div>

        <div class="form-group">
            {{ Form::label('minimum_price', 'Minimum Price', array('class' => 'minimum_price')) }}
            {{ Form::text('minimum_price', $setting->minimum_price ?? 0, ['required', 'class' => 'form-control', 'placeholder' => 'Enter minimum price...']) }}
        </div>

        <div class="form-group">
            {{ Form::label('calculation_type', 'Calculation Type', array('class' => 'calculation_type')) }}
            @php
                $calculation_type = $Model('AttributeValue')::getValues('Calculation Type');
            @endphp
            <select class="form-select" name="calculation_type">
                <option>Select calculation type</option>
                @foreach ($calculation_type as $index => $option)
                    <option value="{{ $option->id ?? NULL }}"
                        {{ !empty($setting) && $setting->calculation_type == $option->id ? 'selected' : '' }}>
                        {{ $option->value ?? NULL }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('counter_type', 'Counter Type', array('class' => 'counter_type')) }}
            @php
                $counter_type = $Model('AttributeValue')::getValues('Counter Type');
            @endphp
            <select class="form-select" name="counter_type">
                <option>Select counter type</option>
                @foreach ($counter_type as $index => $option)
                    <option value="{{ $option->id ?? NULL }}"
                        {{ !empty($setting) && $setting->counter_type == $option->id ? 'selected' : '' }}>
                        {{ $option->value ?? NULL }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('material_available', 'Is Material Available', array('class' => 'material_available')) }}
            <div class="form-check d-inline-block">
                <label class="radio-inline d-block">
                    {{ Form::radio('material_available', 'Yes', (!empty($setting) ? (($setting->material_available == 'Yes') ? TRUE : FALSE) : TRUE), ['required' => 'required', 'class' => 'radio']) }}
                    Yes
                </label>
                <label class="radio-inline  d-block">
                    {{ Form::radio('material_available', 'No', (!empty($setting) ? (($setting->material_available == 'No') ? TRUE : FALSE) : NULL), ['required' => 'required','class' => 'radio']) }}
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('storey_available', 'Is Storey Available', array('class' => 'storey_available')) }}
            <div class="form-check d-inline-block">
                <label class="radio-inline d-block">
                    {{ Form::radio('storey_available', 'Yes', (!empty($setting) ? (($setting->storey_available == 'Yes') ? TRUE : FALSE) : TRUE), ['required' => 'required', 'class' => 'radio']) }}
                    Yes
                </label>
                <label class="radio-inline  d-block">
                    {{ Form::radio('storey_available', 'No', (!empty($setting) ? (($setting->storey_available == 'No') ? TRUE : FALSE) : null), ['required' => 'required', 'class' => 'radio']) }}
                    No
                </label>
            </div>
        </div>
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
                    <option value="{{ $option->id ?? NULL }}"
                        {{ !empty($setting) && $setting->radio_design == $option->id ? 'selected' : '' }}>
                        {{ $option->value ?? NULL }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('computable', 'Computable', array('class' => 'computable')) }}
            <div class="form-check d-inline-block">
                <label class="radio-inline d-block">
                    {{ Form::radio('computable', 'Yes', (!empty($setting) ? (($setting->computable == 'Yes') ? TRUE : FALSE) : TRUE), ['required' => 'required', 'class' => 'radio']) }}
                    Yes
                </label>
                <label class="radio-inline  d-block">
                    {{ Form::radio('computable', 'No', (!empty($setting) ? (($setting->computable == 'No') ? TRUE : FALSE) : null), ['required' => 'required', 'class' => 'radio']) }}
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('tooltips', 'Tool Tips', array('class' => 'tooltips')) }}
            <textarea type="text" class="wysiwyg" id="wysiwyg" name="tooltips_content"
                      class="form-control">{{ isset($setting) ? $setting->tooltips_content : null }}</textarea>
        </div>
        <div class="form-group mt-2">
            {{ Form::label('notes', 'Notes', array('class' => 'notes')) }}

            <textarea type="text" class="wysiwyg" id="wysiwyg1" name="notes"
                      class="form-control">{{ isset($setting) ? $setting->notes : null }}</textarea>
        </div>
    @endslot
@endcomponent
