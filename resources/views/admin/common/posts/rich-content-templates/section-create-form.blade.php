<div id="service_content_breakdown">
    <div class="content_form">
        <?php
        if (isset($termcustomfield)) {
            $route_url = route('common_post_custom_field_update');
        } else {
            $route_url = route('common_post_custom_field_store');
        }
        ?>

        <form action="{{ $route_url }}" method="post">
            @csrf
            @if(isset($termcustomfield))
                <input type="hidden" value="{{ $termcustomfield->id }}"
                       name="content_id"
                       class="form-control"/>
            @else
{{--                <input type="hidden" value="{{ request()->id ?? request()->id }}"--}}
{{--                       name="content_term_id"--}}
{{--                       class="form-control"/>--}}
                <input type="hidden" value="{{  request()->id }}"
                       name="content_term_id"
                       class="form-control"/>
            @endif
            <div class="form-group">
                {{ Form::label('content_type', 'Content Type', array('class' => 'content_type')) }}

                @php
                    $grps = $Model('TermCustomField')::where('content_type', 'Term Title')
                            ->where('content_zone', request()->zone)->where('content_term_id', request()->id)->first();
                    $groups = $Query::getEnumValues('term_custom_fields', 'content_type');
                @endphp
                <select name="content_type" class="form-control" required="required">
                    <option value="">Select a group</option>
                    @foreach($groups as $group)
                        @if(isset($termcustomfield) &&  $termcustomfield->content_type ==  $group)
                            <option value="{{ $group }}"
                                {{ isset($termcustomfield) && $termcustomfield->content_type ==  $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @elseif(!empty($grps) && $grps['content_type'] == $group)

                        @else
                            <option value="{{ $group }}"
                                {{ isset($termcustomfield) && $termcustomfield->content_type ==  $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('content_title', 'Content Title', array('class' => 'content_title')) }}
                <input type="text"
                       value="{{ isset($termcustomfield) ? $termcustomfield->content_title : '' }}"
                       name="content_title" class="form-control" id="content_title"/>
            </div>
            {{--            @if(isset($termcustomfield) && $termcustomfield->content_type == 'Term Title')--}}
            <div class="form-group">
                {{ Form::label('content_seo_url', 'SEF URL', array('class' => 'content_seo_url')) }}
                <input type="text"
                       value="{{ isset($termcustomfield) ? $termcustomfield->content_seo_url : '' }}"
                       name="content_seo_url" class="form-control" id="content_seo_url"/>
            </div>
            {{--            @else--}}
            {{--                <input type="hidden" value="{{ isset($termcustomfield) ? $termcustomfield->content_seo_url : '' }}"--}}
            {{--                       name="content_seo_url"--}}
            {{--                       class="form-control"--}}
            {{--                       id="content_seo_url"/>--}}
            {{--            @endif--}}
            <div class="form-group">
                {{ Form::label('content_sub_title', 'Content Sub Title', array('class' => 'content_sub_title')) }}
                <input type="text"
                       value="{{ isset($termcustomfield) ? $termcustomfield->content_sub_title : '' }}"
                       name="content_sub_title" class="form-control"/>
            </div>

            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                @component('components.media_manager_template', [ 'media_array' => [
                        'button_id' => 'content_image',
                        'label' => 'Menu Image',
                        'input_name' => 'content_image',
                        'row_information' => $termcustomfield ?? NULL,
                        'script_load' => TRUE
                        ]])
                @endcomponent
            </div>


            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                @component('components.media_manager_template', [ 'media_array' => [
                        'button_id' => 'content_page_banner',
                        'label' => 'Page Banner Image',
                        'input_name' => 'content_page_banner',
                        'row_information' => $termcustomfield ?? NULL,
                        'script_load' => TRUE
                        ]])
                @endcomponent
            </div>
            <div class="form-group">
                {{ Form::label('content_details', 'Content Details', array('class' => 'content_details')) }}
                <textarea type="text" class="wysiwyg" id="wysiwyg" name="content_details"
                          class="form-control">{{ isset($termcustomfield) ? $termcustomfield->content_details : null }}</textarea>
            </div>
            <div class="form-group mt-2">
                {{ Form::label('content_short_details', 'Content Short Details', array('class' => 'content_short_details')) }}
                <textarea type="text" class="form-control" name="content_short_details"
                          class="form-control">{{ isset($termcustomfield) ? $termcustomfield->content_short_details : null }}</textarea>
            </div>
            <div class="form-group mt-2">
                <label for="exampleColorInput" class="form-label images">BG Color picker</label>
                <input name="bg_color" type="color" class="form-control form-control-color" id="favcolor"
                       value="{{ !empty($termcustomfield->bg_color) ? $termcustomfield->bg_color : '#ffffff' }}"
                       title="Choose your color">
            </div>
            <div class="form-group mt-2">
                {{ Form::label('is_active', 'Is Active?', array('class' => 'is_active images')) }}

                <input id="active_yes" type="radio" name="is_active"
                       value="Yes" {{ isset($termcustomfield->is_active) && $termcustomfield->is_active == 'Yes' ? 'checked' : '' }}>
                <label for="active_yes" class="me-2">Yes</label>

                <input id="active_no" type="radio" name="is_active"
                       value="No" {{ isset($termcustomfield->is_active) && $termcustomfield->is_active == 'No' ? 'checked' : '' }}>
                <label for="active_no" class="me-2">No</label>
            </div>
            <div class="form-group mt-2">
{{--                {{ Form::label('content_zone', 'Content Zone', array('class' => 'content_zone')) }}--}}
                <input type="hidden" class="form-control" name="content_zone"
                       class="form-control"
                       value="{{ isset($termcustomfield) ? $termcustomfield->content_zone : 8 }}"
                       readonly>
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
