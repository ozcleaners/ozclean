@extends('admin.layouts.master')

@section('title', 'Global Settings')

@section('content')
    <div class="content-wrapper">
        @if(!empty($global_settings))
            <?php $setting = $global_settings[0]; ?>
        @endif
        @component('components.form')
            @slot('form_id')
                @if (!empty($setting->id))
                    term_form333
                @else
                    term_form333
                @endif
            @endslot
            @slot('title')
                Global Settings
            @endslot

            @slot('route')
                @if (!empty($setting->id))
                    {{ route('common_setting_update') }}
                @else
                    {{route('common_setting_store')}}
                @endif
            @endslot


            @slot('fields')
                <div class="row">
                    <div class="col-md-7" id="signupForm">
                        {{ Form::hidden('global_setting_id', (!empty($setting->id) ? $setting->id : ''), ['type' => 'hidden']) }}

                        <div class="title-with-border text-center">Common Informations</div>
                        <div class="form-group">
                            {{ Form::label('name', 'Company Name', array('class' => 'name')) }}
                            {{ Form::text('name', (!empty($setting->name) ? $setting->name : NULL), ['class' => 'form-control', 'placeholder' => 'Enter name...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('slogan', 'Company Slogan', array('class' => 'slogan')) }}
                            {{ Form::text('slogan', (!empty($setting->slogan) ? $setting->slogan : NULL), ['class' => 'form-control', 'placeholder' => 'Enter company slogan...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('eshtablished', 'Company Eshtablished', array('class' => 'eshtablished')) }}
                            {{ Form::text('eshtablished', (!empty($setting->eshtablished) ? $setting->eshtablished : NULL), ['class' => 'form-control', 'placeholder' => 'Enter company eshtablished...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('license_code', 'Company License Code', array('class' => 'license_code')) }}
                            {{ Form::text('license_code', (!empty($setting->license_code) ? $setting->license_code : NULL), ['class' => 'form-control', 'placeholder' => 'Enter company license code...']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('phone', 'Company Phone', array('class' => 'phone')) }}
                            {{ Form::text('phone', (!empty($setting->phone) ? $setting->phone : NULL), ['class' => 'form-control', 'placeholder' => 'Enter company phone...']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('order_phone', 'Order By Phone', array('class' => 'order_phone')) }}
                            {{ Form::text('order_phone', (!empty($setting->order_phone) ? $setting->order_phone : NULL), ['class' => 'form-control', 'placeholder' => 'Enter order phone...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'Company Email', array('class' => 'email')) }}
                            {{ Form::text('email', (!empty($setting->email) ? $setting->email : NULL), ['class' => 'form-control', 'placeholder' => 'Enter company email...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('address', 'Address', array('class' => 'address')) }}
                            {{ Form::text('address', (!empty($setting->address) ? $setting->address : NULL), ['class' => 'form-control', 'placeholder' => 'Enter address...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('working_hours', 'Company Working Hours', array('class' => 'working_hours')) }}
                            {{ Form::text('working_hours', (!empty($setting->working_hours) ? $setting->working_hours : NULL), ['class' => 'form-control', 'placeholder' => 'Enter company working hours...']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('admin_name', 'Admin Name', array('class' => 'admin_name')) }}
                            {{ Form::text('admin_name', (!empty($setting->admin_name) ? $setting->admin_name : NULL), ['class' => 'form-control', 'placeholder' => 'Enter admin name...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('admin_phone', 'Admin Phone', array('class' => 'admin_phone')) }}
                            {{ Form::text('admin_phone', (!empty($setting->admin_phone) ? $setting->admin_phone : NULL), ['class' => 'form-control', 'placeholder' => 'Enter admin phone...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('admin_email', 'Admin Email', array('class' => 'admin_email')) }}
                            {{ Form::email('admin_email', (!empty($setting->admin_email) ? $setting->admin_email : NULL), ['class' => 'form-control', 'placeholder' => 'Enter email...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('website', 'Website', array('class' => 'website')) }}
                            {{ Form::text('website', (!empty($setting->website) ? $setting->website : NULL), ['class' => 'form-control', 'placeholder' => 'Enter website...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('facebook_page_id', 'Facebook Page ID', array('class' => 'facebook_page_id')) }}
                            {{ Form::text('facebook_page_id', (!empty($setting->facebook_page_id) ? $setting->facebook_page_id : NULL), ['class' => 'form-control', 'placeholder' => 'Enter facebook page id...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('timezone', 'Timezone (Asia/Dhaka)', array('class' => 'timezone')) }}
                            {{ Form::text('timezone', (!empty($setting->timezone) ? $setting->timezone : NULL), ['class' => 'form-control', 'placeholder' => 'Enter timezone...']) }}
                        </div>
                        <div class="title-with-border text-center">URLs</div>
                        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                            @component('components.media_manager_template', [ 'media_array' => [
                                    'button_id' => 'logo',
                                    'label' => 'Logo',
                                    'input_name' => 'logo',
                                    'row_information' => $setting ?? NULL,
                                    'script_load' => TRUE
                                    ]])
                            @endcomponent
                        </div>
                        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                            @component('components.media_manager_template', [ 'media_array' => [
                                    'button_id' => 'favicon',
                                    'label' => 'Favicon',
                                    'input_name' => 'favicon',
                                    'row_information' => $setting ?? NULL,
                                    'script_load' => FALSE
                                    ]])
                            @endcomponent
                        </div>
                        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                            @component('components.media_manager_template', [ 'media_array' => [
                                    'button_id' => 'header_photo',
                                    'label' => 'Admin Photo URL',
                                    'input_name' => 'header_photo',
                                    'row_information' => $setting ?? NULL,
                                    'script_load' => FALSE
                                    ]])
                            @endcomponent
                        </div>
                        <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                            @component('components.media_manager_template', [ 'media_array' => [
                                    'button_id' => 'admin_photo',
                                    'label' => 'Admin Photo URL',
                                    'input_name' => 'admin_photo',
                                    'row_information' => $setting ?? NULL,
                                    'script_load' => FALSE
                                    ]])
                            @endcomponent
                        </div>
                        <div class="title-with-border text-center">SEO Informations</div>
                        <div class="form-group">
                            {{ Form::label('meta_title', 'Meta Title', array('class' => 'meta_title')) }}
                            {{ Form::text('meta_title', (!empty($setting->meta_title) ? $setting->meta_title : NULL), ['class' => 'form-control', 'placeholder' => 'Enter meta title...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('meta_description', 'Meta Description', array('class' => 'meta_description')) }}
                            {{ Form::textarea('meta_description', (!empty($setting->meta_description) ? $setting->meta_description : NULL), ['class' => 'form-control', 'placeholder' => 'Enter meta description...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('meta_keywords', 'Meta Keywords', array('class' => 'meta_keywords')) }}
                            {{ Form::textarea('meta_keywords', (!empty($setting->meta_keywords) ? $setting->meta_keywords : NULL), ['class' => 'form-control', 'placeholder' => 'Enter meta keywords...']) }}
                        </div>
                    </div>
                    <div class="col-md-5" id="signupForm">
                        <div class="title-with-border text-center">Third party codes</div>
                        <div class="form-group">
                            {{ Form::label('google_map', 'Google Map', array('class' => 'google_map')) }}
                            {{ Form::textarea('google_map', (!empty($setting->google_map) ? $setting->google_map : NULL), ['class' => 'form-control', 'placeholder' => 'Enter google map...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('analytics', 'Google Analytics', array('class' => 'analytics')) }}
                            {{ Form::textarea('analytics', (!empty($setting->analytics) ? $setting->analytics : NULL), ['class' => 'form-control', 'placeholder' => 'Enter google analytics...']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('chat_box', 'Chat Box', array('class' => 'chat_box')) }}
                            {{ Form::textarea('chat_box', (!empty($setting->chat_box) ? $setting->chat_box : NULL), ['class' => 'form-control', 'placeholder' => 'Enter chat box code...']) }}
                        </div>
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
@endsection
@section('cusjs')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
