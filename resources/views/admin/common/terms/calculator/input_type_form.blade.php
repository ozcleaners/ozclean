@php
    $getInputEle = $Model('CalcInputType')::where('attr_id', request()->get('attr_id'))->where('service_id', request()->id)->first();
//    dump($getInputEle);
@endphp
<form action="{{ route('calculator_input_setting_store') }}" method="post">
    @csrf
    <div class="card mb-3">
        <h6>
            <div class="title-with-border ps-3">
                Setup Input Type -
                <strong>
                    {{ $Model('AttributeValue')::getValueById(request()->get('attr_id')) }}
                </strong>
            </div>
        </h6>
        <div class="card-body">

            <div class="xcontent-wrapper" id="changeIt">
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

                                        {{ !empty($getInputEle) && $getInputEle->input_type == $option->id ? 'selected' : '' }}>
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
                                        {{ !empty($getInputEle) && $getInputEle->radio_design == $option->id ? 'selected' : '' }}>
                                        {{ $option->value ?? NULL }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                            @component('components.media_manager_template', [ 'media_array' => [
                                    'button_id' => 'input_icon',
                                    'label' => 'Input Icon',
                                    'input_name' => 'input_icon',
                                    'row_information' => $getInputEle ?? NULL,
                                    'script_load' => TRUE
                                    ]])
                            @endcomponent
                        </div>

                        <input name="attr_id" type="hidden" value="{{ request()->attr_id ?? NULL}}"/>
                        {{--                        <input name="service_id" type="hidden" value="{{ $getInputEle->service_id ?? NULL }}"/>--}}
                        <input name="service_id" type="hidden" value="{{ request()->id }}"/>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer form-submit_btn">
            {{ Form::submit('Save Changes', ['class' => 'btn blue']) }}
        </div>
    </div>

</form>
