@php
    $banner = get_frontend_setting('we_are_cleaners', true);
@endphp
<?php /*

<div class="container-fluid">
    <div class="header-banner-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-9">
                    <!----------------- HEADER FORM ------------------>
                    <div class="form-wrapper" style="color: #FFFFFF;">
                        <h4 style="color: #FFFFFF;">
                            {!! $banner['meta_title'] ?? NULL !!}
                        </h4>
                        <p>
                            {!! $banner['meta_value'][0] ?? NULL !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 */ ?>


<div class="row justify-content-center m-0 py-0 py-lg-3">
    <div class="col-xl-10 col-lg-11">
        <div class="row equal">
            <div class="col-xl-9 col-lg-7">
                <div class="header-banner-wrapper" style="height: 100%; border-radius: 0% 0 0 0%;"></div>
            </div>
            <div class="col-xl-3 col-lg-5">
                <div class="form-wrapper p-3 banner_right_text_wrap"
                     style="">
                    <div style="" class="p-5 banner_right_text">
                        <h4>
                            {!! $banner['meta_title'] ?? NULL !!}
                        </h4>
                        <p>
                            {!! $banner['meta_value'][0] ?? NULL !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>

</style>
