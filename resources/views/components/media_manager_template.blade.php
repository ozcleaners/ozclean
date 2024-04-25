{{--@dd($media_array)--}}
<div class="form-group mb-2">
    {{ Form::label('images', '&nbsp;', array('class' => 'images')) }}
    <a class="obtn green" id="{{ $media_array['button_id'] }}" href="#0">Insert Media</a>
</div>

<div class="form-group">
    {{ Form::label('images', $media_array['label'], array('class' => 'images')) }}
    <?php $column = $media_array['input_name']; ?>

    @if(!empty($media_array['row_information']->$column))
        <?php $im = $media_array['row_information']->$column; ?>
        {{ Form::text($column, (!empty($im) ? $im : NULL), [
            'style' => 'width:57%',
            'type' => 'text',
            'id' => $media_array['button_id'] . '_image',
            'class' => 'form-control',
            'placeholder' => 'Enter image...']) }}
    @else
        {{ Form::text($column, NULL, [
            'style' => 'width:50%',
            'type' => 'text',
            'id' => $media_array['button_id'] . '_image',
            'class' => 'form-control',
            'placeholder' => 'Enter image...']) }}
    @endif
    <small id="show_image_names"></small>
    <img src="{{ $Media::iconSize($media_array['row_information']->$column ?? NULL)  }}"
         id="{{ $media_array['button_id'] }}"
         alt="">
</div>

@section('cusjs')
    @parent
    {!! $MediaManger( $media_array['button_id'], $media_array['button_id'] . '_image', ['scriptLoad' => $media_array['script_load'] ?? FALSE ]) !!}
@endsection
