<div id="service_content_breakdown">
    <div class="content_form">
        <?php
        if (isset($termcustomfieldbreakdown)) {
            $route_url = route('common_post_custom_field_breakdown_update') . "?zone=" . request()->get('zone') . "&section_id=" . request()->get('custom_field_id') . "&custom_field_breakdown_id=" . request()->get('custom_field_breakdown_id');
        } else {
            $route_url = route('common_post_custom_field_breakdown_store') . "?zone=" . request()->get('zone') . "&section_id=" . request()->get('custom_field_id');
        }
        ?>

        <form action="{{ $route_url }}" method="post">
            @csrf
            @if(isset($termcustomfieldbreakdown))
                <input type="hidden" value="{{ request()->custom_field_id }}"
                       name="term_custom_field_id"
                       class="form-control"/>
                <input type="hidden" value="{{ $termcustomfieldbreakdown->id }}"
                       name="breakdown_id"
                       class="form-control"/>
                <input type="hidden" value="{{ request()->id }}"
                       name="content_term_id"
                       class="form-control"/>
            @else
                <input type="hidden" value="{{ request()->custom_field_id }}"
                       name="term_custom_field_id"
                       class="form-control"/>
                <input type="hidden" value="{{ request()->id ?? request()->id }}"
                       name="content_term_id"
                       class="form-control"/>
            @endif

            <div class="form-group">
                {{ Form::label('content_type', 'Content Type', array('class' => 'content_type')) }}

                <select name="content_type" class="form-control" required="required">
                    @php
                        $groups = $Query::getEnumValues('term_custom_fields_breakdown', 'content_type');
                    @endphp
                    <option value="">Select a group</option>


                    @foreach($groups as $group)
                        <option value="{{ $group }}"
                            {{ isset($termcustomfieldbreakdown) && $termcustomfieldbreakdown->content_type ==  $group ? 'selected' : '' }}>
                            {{ $group }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {{ Form::label('content_title', 'Content Title', array('class' => 'content_title')) }}
                <input type="text"
                       value="{{ isset($termcustomfieldbreakdown) ? $termcustomfieldbreakdown->content_title : '' }}"
                       name="content_title" class="form-control"/>
            </div>
            <div class="form-group">
                {{ Form::label('content_sub_title', 'Content Sub Title', array('class' => 'content_sub_title')) }}
                <input type="text"
                       value="{{ isset($termcustomfieldbreakdown) ? $termcustomfieldbreakdown->content_sub_title : '' }}"
                       name="content_sub_title" class="form-control"/>
            </div>
            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                @component('components.media_manager_template', [ 'media_array' => [
                        'button_id' => 'content_image',
                        'label' => 'Image',
                        'input_name' => 'content_image',
                        'row_information' => $termcustomfieldbreakdown ?? NULL,
                        'script_load' => TRUE
                        ]])
                @endcomponent
            </div>

            <div class="form-group">
                {{ Form::label('font_awesome', 'Font Awesome', array('class' => 'font_awesome')) }}
                <input type="text"
                       value="{{ isset($termcustomfieldbreakdown) ? $termcustomfieldbreakdown->font_awesome : '' }}"
                       name="font_awesome" class="form-control"/>
            </div>

            <div class="form-group">
                {{ Form::label('content_details', 'Content Details', array('class' => 'content_details')) }}
                <textarea type="text" class="wysiwyg" id="wysiwyg" name="content_details"
                          class="form-control">{{ isset($termcustomfieldbreakdown) ? $termcustomfieldbreakdown->content_details : null }}</textarea>
            </div>
            <div class="form-group">
                <label style="width: 20%;">&nbsp;</label>
                <div class="form-submit_btn">
                    <button type="submit" id="menu-generator-cat-submit"
                            class="btn blue">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
