<form class="" method="post" action="{{route('common_term_zone_other_setting_store')}}">
    @csrf
    <input type="hidden" name="service_id" value="{{request()->id}}">
    <input type="hidden" name="zone_id" value="{{$zone_id}}">
    <div class="form-group">
        <label for="book_day_after_days" class="book_day_after">Book Day After Days</label>
        <input required type="text"
               value="{{$Model('TermZoneOtherSetting')::getValue(request()->id,$zone_id, 'book_day_after_days')}}"
               name="setting[book_day_after_days]" class="form-control"
               id="book_day_after_days">
    </div>

    <div class="form-group">
        <label for="" class="">Is Active</label>
        <div class="form-check d-inline-block">
            <input required type="radio"
                   {{$Model('TermZoneOtherSetting')::getValue(request()->id,$zone_id, 'zone_content_is_active') == 'Yes' ? 'checked' : null }}
                   value="Yes"
                   name="setting[zone_content_is_active]" class=""
                   id="zone_content_is_active_yes">
            <label for="zone_content_is_active_yes">Yes</label>

            <input required type="radio"
                   {{$Model('TermZoneOtherSetting')::getValue(request()->id,$zone_id, 'zone_content_is_active') == 'No' ? 'checked' : null }}
                   value="No"
                   name="setting[zone_content_is_active]" class=""
                   id="zone_content_is_active_no">
            <label for="zone_content_is_active_no">No</label>
        </div>
    </div>

    <div class="form-group">
        <label style="width: 20%;">&nbsp;</label>
        <div class="form-submit_btn">

            <button type="submit" id="menu-generator-cat-submit" class="btn blue">
                Update
            </button>
        </div>
    </div>

</form>


