@component('components.form')
    @slot('title')
        @if (!empty(request()->id && request()->get('storey_id')))
            Edit storey setting
        @endif
    @endslot
    @slot('route')
        @if (!empty(request()->id && request()->get('storey_id')))
            {{ route('calculator_setting_update') }}
        @endif
    @endslot

    @php
        $storey = $Model('CalcBasicSetting')::where('section_id', request()->get('section_id'))->where('service_id', request()->id)->where('id', request()->get('storey_id'))->first();
    @endphp

    @slot('fields')

        {{ Form::hidden('which_module', 'Other', ['type' => 'hidden']) }}
        {{ Form::hidden('service_id', (!empty(request()->id) ? request()->id : NULL), ['type' => 'hidden']) }}
        @if (!empty(request()->get('section_id')))
            {{ Form::hidden('calc_basic_setting_id', request()->get('storey_id'), ['type' => 'hidden']) }}
        @endif
        {{ Form::hidden('setting_type', 31, ['type' => 'hidden']) }}
        {{ Form::hidden('service_slug', $Model('Term')::getColumn(request()->id, 'seo_url') ?? NULL, ['type' => 'hidden']) }}
        <div class="form-group">
            {{ Form::label('setting_title', 'Title', array('class' => 'setting_title')) }}
            {{ Form::text('setting_title', (!empty($storey->setting_title) ? $storey->setting_title : old('setting_title')), ['required', 'class' => 'form-control', 'placeholder' => 'Enter title...']) }}
        </div>
        <div class="form-group">
            {{ Form::label('service_icon', 'Service Icon', array('class' => 'service_icon')) }}
            {{ Form::text('service_icon', (!empty($storey->service_icon) ? $storey->service_icon : old('service_icon')), ['class' => 'form-control', 'placeholder' => 'Enter service icon...']) }}
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
                        {{ !empty($storey) && $storey->equation_type == $option->id ? 'selected' : '' }}>
                        {{ $option->value ?? NULL }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('rate', 'Rate', array('class' => 'rate')) }}
            {{ Form::text('rate', $storey->rate ?? NULL, ['required', 'class' => 'form-control', 'placeholder' => 'Enter rate...']) }}
        </div>

        <div class="form-group">
            {{ Form::label('show_on_calculator', 'Show on calculator', array('class' => 'show_on_calculator')) }}
            <div class="form-check d-inline-block">
                <label class="radio-inline d-block">
                    {{ Form::radio('show_on_calculator', 'Yes', (!empty($storey) ? (($storey->show_on_calculator == 'Yes') ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                    Yes
                </label>
                <label class="radio-inline  d-block">
                    {{ Form::radio('show_on_calculator', 'No', (!empty($storey) ? (($storey->show_on_calculator == 'No') ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('computable', 'Computable', array('class' => 'computable')) }}
            <div class="form-check d-inline-block">
                <label class="radio-inline d-block">
                    {{ Form::radio('computable', 'Yes', (!empty($storey) ? (($storey->computable == 'Yes') ? TRUE : FALSE) : TRUE), ['class' => 'radio']) }}
                    Yes
                </label>
                <label class="radio-inline  d-block">
                    {{ Form::radio('computable', 'No', (!empty($storey) ? (($storey->computable == 'No') ? TRUE : FALSE) : null), ['class' => 'radio']) }}
                    No
                </label>
            </div>
        </div>
        <input name="section_id" type="hidden" value="{{ request()->get('section_id') }}"/>
        <input name="service_id" type="hidden" value="{{ request()->id }}"/>
    @endslot
@endcomponent


<div class="card mb-3">
    <h6>
        <div class="title-with-border ps-3">
            Other no of storey of this service
        </div>
    </h6>
    <div class="card-body">
        @php
            $storeys = $Model('CalcBasicSetting')::where('section_id', request()->get('section_id'))->get();
        @endphp
        @if(count($storeys) > 0)
            <table class="table table-bordered">
                <tr>
                    <th style="width: 40%;" class="text-center">
                        Details
                    </th>
                    <th class="text-center">Extras</th>
                    <th class="text-center">Actions</th>
                </tr>
                @foreach($storeys as $storey)
                    <tr>
                        <td>
                            <strong>Title: </strong>
                            {{ $storey->setting_title ?? NULL }}
                            <br/>
                            <strong>
                                Equation Type:
                            </strong>
                            {{ $Model('AttributeValue')::getValueById($storey->equation_type) }}
                            <br/>
                            <strong>Rate:</strong>
                            {{ $storey->rate ?? NULL }}
                        </td>
                        <td>

                        </td>
                        <td>
                            <a class="d-inline-block py-0"
                               href="{{ route('calculator_service_setting_index', [request()->id]) }}?storey_id={{ $storey->id }}&section_id={{ request()->get('section_id') }}">
                                <i class="icon-edit text-primary"></i>
                            </a>
                            {!! $ButtonSet::delete('calculator_setting_destroy', $storey->id) !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            This service don't have any materials
        @endif
    </div>
</div>

