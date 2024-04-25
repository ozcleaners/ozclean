@component('components.form')
    @slot('title')
        @if (!empty(request()->id && request()->get('material_id')))
            Edit material setting
        @endif
    @endslot
    @slot('route')
        @if (!empty(request()->id && request()->get('material_id')))
            {{ route('calculator_material_setting_update') }}
        @endif
    @endslot

    @php
        $material = $Model('CalcMaterialSetting')::where('section_id', request()->get('section_id'))->where('service_id', request()->id)->where('id', request()->get('material_id'))->first();
    @endphp

    @slot('fields')
        {{ Form::hidden('service_id', $material->service_id, ['type' => 'hidden']) }}
        @if (!empty(request()->get('material_id')))
            {{ Form::hidden('calc_material_setting_id', request()->get('material_id'), ['type' => 'hidden']) }}
        @endif
        <div class="form-group">
            {{ Form::label('material_title', 'Material Title', array('class' => 'material_title')) }}
            {{ Form::text('material_title', (!empty($material->material_title) ? $material->material_title : old('material_title')), ['required', 'id' => 'material_title', 'class' => 'form-control', 'placeholder' => 'Enter material title...']) }}
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
                        {{ !empty($material) && $material->equation_type == $option->id ? 'selected' : '' }}>
                        {{ $option->value ?? NULL }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('rate', 'Rate', array('class' => 'rate')) }}
            {{ Form::text('rate', $material->rate ?? NULL, ['required', 'class' => 'form-control', 'placeholder' => 'Enter rate...']) }}
        </div>
        <div
            class="form-group">{{ Form::label('extras_connection', 'Extras Connection', array('class' => 'extras_connection')) }}
            <div class="form-check d-inline-block checkboxFontSize">
                @php
                    $extras = $Model('CalcServiceSetting')::where('setting_option_type', 35)->where('service_id', request()->id)->get();
                    $exploded = explode(',', $material->extras_connection);
                    //dump(request()->id);
                @endphp
                @foreach($extras as $extra)
                    <input type="checkbox" name="extras_connection[]"
                           value="{{ $extra->id }}" {{ (in_array($extra->id, $exploded)) ? 'checked' : NULL  }}/>
                    {{ $extra->service_title }}
                    - <small>Base Price: {{ $extra->base_price ?? NULL }} </small><br/>
                @endforeach
            </div>
        </div>
        <input name="section_id" type="hidden" value="{{ request()->get('section_id') }}"/>
        <input name="service_id" type="hidden" value="{{ request()->id }}"/>
    @endslot
@endcomponent
<div class="card mb-3">
    <h6>
        <div class="title-with-border ps-3">
            Other materials of this service
        </div>
    </h6>
    <div class="card-body">
        @php
            $materials = $Model('CalcMaterialSetting')::where('section_id', request()->get('section_id'))->get();
        @endphp
        @if(count($materials) > 0)
            <table class="table table-bordered">
                <tr>
                    <th style="width: 40%;" class="text-center">
                        Details
                    </th>
                    <th class="text-center">Extras</th>
                    <th class="text-center">Actions</th>
                </tr>
                @foreach($materials as $material)
                    <tr>
                        <td>
                            <strong>Title: </strong>
                            {{ $material->material_title ?? NULL }}
                            <br/>
                            <strong>
                                Equation Type:
                            </strong>
                            {{ $Model('AttributeValue')::getValueById($material->equation_type) }}
                            <br/>
                            <strong>Rate:</strong>
                            {{ $material->rate ?? NULL }}
                        </td>
                        <td>
                            @php
                                $extrass = $Query::accessModel('CalcServiceSetting')::where('service_id', request()->id)
                                            ->whereIn('id', explode(',', $material->extras_connection))
                                            ->orderBy('sorting_order', 'asc')->get();
                            @endphp
                            @foreach($extrass as $extra)
                                <a href="">
                                    {{ $extra->service_title ?? NULL }}
                                    <br/>
                                </a>
                            @endforeach
                        </td>
                        <td>
                            <a class="d-inline-block py-0"
                               href="{{ route('calculator_service_setting_edit', [request()->id]) }}?material_id={{ $material->id }}&section_id={{ request()->get('section_id') }}">
                                <i class="icon-edit text-primary"></i>
                            </a>
                            {!! $ButtonSet::delete('calculator_material_setting_destroy', $material->id) !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            This service don't have any materials
        @endif
    </div>
</div>
