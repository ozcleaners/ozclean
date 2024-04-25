<?php

namespace App\Helpers\admin;

class MediaManagerTemplate
{
    private $buttonId;
    private $inputId;

    public function __construct($buttonId, $inputId)
    {
        $this->buttonId = $buttonId;
        $this->inputId = $inputId;
    }


    public function render()
    { ?>
        <div class="form-group mb-2">
            {{ Form::label('images', '&nbsp;', array('class' => 'images')) }}
            <a class="obtn green" id="termHomeImage" href="">Insert Media</a>
        </div>
        <div class="form-group">
            <label class="images" for="images">Term Home Image</label>
            @if(!empty($term->home_image))
            <?php
            //$im = image_ids($product->images, TRUE, TRUE);
            $im = $term->home_image;
            ?>


            {{ Form::text('home_image', (!empty($im) ? $im : NULL), ['style'=>'width:57%', 'type' => 'text', 'id' => 'term_home_image', 'class' => 'form-control', 'placeholder' => 'Enter image IDs...'])
            }}
            @else
            {{ Form::text('home_image', NULL, ['style'=>'width:50%', 'type' => 'text',
                'id' => 'term_home_image',
                'class' => 'form-control',
                'placeholder' => 'Enter image...']) }}
            @endif
            <small id="show_image_names"></small>
            <img src="{{ $Media::iconSize($term->home_image ?? NULL)  }}"
                 id="termHomeImage"
                 alt="">
        </div>
    <?php }


}
