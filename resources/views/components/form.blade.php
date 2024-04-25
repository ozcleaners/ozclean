{{ Form::open(array('url' => $route, 'method' => 'post', 'value' => 'PATCH', 'id' => $form_id ?? NULL, 'files' => true, 'autocomplete' => 'off')) }}
<div class="card mb-3">
    <h6>
        <div class="title-with-border ps-3">
            {{ $title }}
        </div>
    </h6>
    <div class="card-body">
        {{ $method ?? '' }}
        {{ $fields ?? '' }}
    </div>

    <div class="card-footer form-submit_btn">
        {{ Form::submit('Save Changes', ['class' => 'btn blue']) }}
    </div>
</div>
{{ Form::close() }}
