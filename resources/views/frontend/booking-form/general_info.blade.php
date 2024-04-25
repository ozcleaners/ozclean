@extends('frontend.layouts.master')
@section('metas')
    <title>OZ Cleaners | Online quotation & booking form</title>
    <meta name="description" content="We made it so easy, any cleaning service, anywhere in Australia, you want to book or looking for quotation only, here it is.">
    <meta name="keywords" content="Residential cleaning, Commercial cleaning, Exterior cleaning, Interior cleaning, End of Lease Cleaning, Window cleaning, Solar panel cleaning, Strata Cleaning, High pressure cleaning, After builders cleaning, Renovation cleaning, Gutter cleaning, carpet steam cleaning, oven cleaning, BBQ cleaning, Spring cleaning, Regular house cleaning, Regular office cleaning, roof cleaning, roof painting">
    <link href="https://ozcleaners.com.au/booking_form" rel="canonical">
    <meta name="author" content="Oz Cleaners">
    <meta name="zone" content="Australia">
@endsection
@section('content')
    <div class="container mt-5">
        <div class="mobile-top-spacer"></div>
        <div class="section-heading">
            <div class="heading-with-icon-wrap">
                <h1 class="heading-with-icon-inner section-name-text">
                    <div class="heading-icon"></div>
                    Online Quote
                </h1>
            </div>

            <h3 class="contact-info-content-title st-default quote-text-summary">
                <span class="">Submit following information to get an instant quote</span>
            </h3>
        </div>
        <form action="{{ route('frontend_booking_general_info_store') }}" method="post" id="booking_form">
            @csrf
            <input type="hidden" name="hash_code" value="{{ date('YmdHis') }}" ?>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <span class="form-field-wrap">
                        <input type="text" value="" name="full_name" id="full_name" class="contact-form-wrap-control "
                               placeholder="Contact Name *" required>
                    </span>
                </div>
                <div class="col-lg-5 col-md-5">
                    <span class="form-field-wrap">
                        <input type="email" value="" name="email_address" id="email_address" class="contact-form-wrap-control"
                               placeholder="Email Address *" required>
                    </span>
                </div>

                <div class=" col-lg-2 col-md-2 col-7">
                    <span class="form-field-wrap">
                        <input type="text" value="" name="contact_no"  id="contact_no" class="contact-form-wrap-control"
                               placeholder="Contact No. ">
                    </span>
                </div>
                <div class=" col-lg-2 col-md-2 col-5">
                    <span class="form-field-wrap">
                        <input type="text" value="" name="post_code" id="post_code" class="contact-form-wrap-control"
                               placeholder="Postcode *" required>
                    </span>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <label>Required service for</label>
                    <span class="form-field-wrap align-items-center">
                        @php
                            $services = $Model('Term')::where('parent', 3)->get();
                        @endphp

                        @foreach($services as $key => $value)
                            <div class="form-check d-inline-block mr-4">
                                <label class="containerRadio form-check-label fw-400 mb-1" for="{{$value->id}}">
                                    <input id="{{$value->id}}" class="form-check-input select-radio mr-1 term_no_get"
                                           name="term_parent" type="radio" value="{{ $value->id ?? NULL }}">
                                    <span class="checkmark"></span>
                                    <img src="{{$Media::iconSize($value->term_menu_icon)}}" class="mx-3"
                                         style="width: 45px;">
                                        <span class="term_parent_{{$value->id}}">{{ $value->name ?? NULL }}</span>
                                </label>
                            </div>
                        @endforeach
                        {{--                        <select name="term_parent" id="term_no_get" class="xform-control contact-form-wrap-control">--}}
                        {{--                            <option value="">Select Service Group</option>--}}
                        {{--                            @foreach($services as $key => $value)--}}
                        {{--                                <option value="{{ $value->id ?? NULL }}">{{ $value->name ?? NULL }}</option>--}}
                        {{--                            @endforeach--}}
                        {{--                        </select>--}}
                    </span>
                </div>
                <div class="col-lg-4 col-md-4" id="service_cat" style="display: none">
                    <label>Required service</label>
                    <span class="form-field-wrap">
                        <select name="sub_term_id" id="level_no_get" required style="width: 100%;" multiple
                                class="xform-control contact-form-wrap-control select2 select2-hidden-accessible">
{{--                            <option value="">Select a parent...</option>--}}
                        </select>
                    </span>
                    {{--                    <div id="level_no_get" clas="py-3"></div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-field-wrap justify-right">
                        <button type="submit" id="general_info_btn"
                                class="xcontact-form-submit-button get_quote_btn_2 btn see_price">
                            See Price
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>






    <!-- Popup Calculator Form -->
    <!-- Calc Service Modal -->
    <div class="calc-modal modal fade calculator_form calculator_form_service_modal " data-backdrop="static"
         data-keyboard="false" id="calcModal" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #203647; color: #fff">
                    Contact us
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend_booking_general_info_popup_store') }}" method="post">
                        @csrf
                        <input type="hidden" name="hash_code" value="{{ date('YmdHis') }}" ?>
                        <input type="hidden" name="service_id" id="input_service_id" value="" required>
                        <input type="hidden" name="sub_service_id" id="input_sub_service_id" value="" required>
                        <div class="modal-details">
                            <p class="text-center">Please fill this form. We will get back to you soon.</p>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="name" class="name">Full Name</label>

                                        <input required="" class="form-control" placeholder="Enter Name" name="full_name" type="text" id="input_name">

                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="email" class="email">Email Address</label>

                                        <input placeholder="" id="input_email" class="form-control" required="required" name="email_address" type="text">
                                        <span class="text-danger myform-error" v-text="msg.email"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="phone" class="phone">Phone </label>
                                        <input placeholder="" id="input_phone" class="form-control" required="required" name="contact_no" type="text">
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="input_post_code" class="phone">Post code </label>
                                        <input required placeholder="" id="input_post_code" class="form-control" required="required" name="post_code"  type="text">

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="unit_no" class="unit_no">Unit No.</label>
                                        <input class="form-control" placeholder="Enter Unit No." name="unit_no" type="text" id="unit_no">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="address" class="addresss">Street Address</label>
                                        <input required="" autocomplete="off" id="formatted_address" class="form-control geocomplete" placeholder="Enter Address" name="address" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="subject" class="suburb">Suburb</label>
                                        <input required="" autocomplete="off" id="suburb" class="form-control" placeholder="Enter Suburb" name="suburb" type="text">
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="state" class="state">State</label>
                                        <input required="" autocomplete="off" id="state" class="form-control" placeholder="Enter state" name="state" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="subject" class="subject">Subject</label>
                                        <input readonly required="" autocomplete="off" id="subject" class="form-control" placeholder="Enter Subject" name="subject" type="text">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <label for="massage" class="massage">Description of work or services needed</label>
                                    <textarea required rows="4" class="form-control" placeholder="Enter Description of work or services needed.." id="massage" name="massage" cols="50"></textarea>
                                </div>
                            </div>



                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" style="border-width: 1px;" class="btn get_quote_btn_2">
                                Submit
                            </button>
                            <button type="button"
                                    class="btn btn-outline-danger btn_radius modal-cancel modal-close "
                                    data-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End -->



@endsection
@section('cusjs')
    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();

            $('.select2').select2({
                width: 'resolve',
                allowClear: true,
                placeholder: 'Select a Service',
                multiple: false
            });

            $('#general_info_btn').attr('disabled', 'disabled');

            $('.term_no_get').on('change', function () {
                let term_id = $(this).val();

                let url = "{{ route( 'frontend_sub_terms_getter', '')  }}/" + term_id;

                $.get(url, function (data, status) {
                    $('#level_no_get').html(data.html);
                    $('#service_cat').attr('style', 'display: block;');
                    $('#general_info_btn').removeAttr('disabled', 'disabled');
                });
            });


            //Servie Popup if selected service calcultor is popup
            $('#service_cat').on('change', '#level_no_get', function(){
                let calcTemp = $(this).find(':selected').data('calc_template');
                if(calcTemp == 'popup'){
                    let calcModal = '#calcModal';
                    $(calcModal+ ' #input_name').val($('#full_name').val())
                    $(calcModal+ ' #input_email').val($('#email_address').val())
                    $(calcModal+ ' #input_phone').val($('#contact_no').val())
                    $(calcModal+ ' #input_post_code').val($('#post_code').val())
                    $(calcModal+ ' #input_sub_service_id').val($(this).find(':selected').val())
                    $(calcModal+ ' #input_service_id').val($('.term_no_get:checked').val())
                    $(calcModal+ ' #subject').val($('.term_parent_'+$('.term_no_get:checked').val()).text()+' - '+$('#level_no_get').find(':selected').text())
                    let check =  checkPostcodeServiceAvailable();

                    if(check){
                        $(calcModal).modal('show');
                    }else {
                        // checkPostcodeServiceAvailable()
                        let postcode = $('#post_code').val();
                        let service = $('#service_cat').find(':selected').text();
                        let pService = $('.term_no_get:checked').val();
                            pService = $('.term_parent_'+pService).text();
                        let img = '<img src="https://ozcleaners.com.au/storage/uploads/fullsize/2022-09/sorry_1663320788.jpg" style="width: 80px; margin: 0 auto; display: block;"> <br>'
                        let  msg = `${img} We are not providing <b>${service}</b> service for <b>${pService}</b> in your area.`;
                        alert(msg);
                    }

                }else{
                    let check =  checkPostcodeServiceAvailable();
                    // console.log(check);
                    if(check){
                        $('button#general_info_btn').prop('disabled', false)
                    }else {
                        // checkPostcodeServiceAvailable()
                        let postcode = $('#post_code').val();
                        let service = $('#service_cat').find(':selected').text();
                        $('#level_no_get').val(null);
                        $('button#general_info_btn').prop('disabled', true)
                        let pService = $('.term_no_get:checked').val();
                        pService = $('.term_parent_'+pService).text();
                        let img = '<img src="https://ozcleaners.com.au/storage/uploads/fullsize/2022-09/sorry_1663320788.jpg" style="width: 80px; margin: 0 auto; display: block;"> <br>'
                        let  msg = `${img} We are not providing <b>${service}</b> service for <b>${pService}</b> in your area.`;
                        alert(msg);
                    }
                }
            })

            $('.modal-cancel').on('click', function(){
                $('#level_no_get').val(null)
            })

            $('.see_price').click(function(){

            })

            //form submit
            $('form#booking_form').submit(function(e){
                let check =  checkPostcodeServiceAvailable();
                if(check){
                    // $('form#booking_form')
                    return true;
                }else {
                    e.preventDefault();
                    let postcode = $('#post_code').val();
                    let service = $('#service_cat').find(':selected').text();
                    $('#level_no_get').val(null);
                    $('button#general_info_btn').prop('disabled', true)
                    let pService = $('.term_no_get:checked').val();
                    pService = $('.term_parent_'+pService).text();
                    let img = '<img src="https://ozcleaners.com.au/storage/uploads/fullsize/2022-09/sorry_1663320788.jpg" style="width: 80px; margin: 0 auto; display: block;"> <br>'
                    let  msg = `${img} We are not providing <b>${service}</b> service for <b>${pService}</b> in your area.`;
                    alert(msg);
                    return false;
                }
            })

            function checkPostcodeServiceAvailable(){
                let postcode = $('#post_code').val();
                let service = $('#service_cat').find(':selected').val();
                let check = false;
                 $.ajax({
                    method: 'GET',
                    url :  `{{route('api_admin_check_postcode_service', ['', ''])}}/`+postcode+'/'+service,
                    async: false,
                }).done(function(res){
                    // console.log(res);
                    check = res.status;
                    //return check;
                });
                return check;
            }
        });
    </script>

    <style>
        @media screen and (max-width: 991px) {
           .quote-text-summary {
               font-size: 18px !important;
               line-height: 1.5em;
           }

            .select2-search--dropdown {
                display: block;
                padding: 4px;
                position: absolute;
                bottom: -92px;
                width: 100%;
                border: 0px solid #333;
                outline: none;
                background: #f5f5f5;
                top: unset !important;
            }
        }



        .select2-hidden-accessible {
            border: 0 !important;
            clip: rect(0 0 0 0) !important;
            height: 1px !important;
            margin: -1px !important;
            overflow: hidden !important;
            padding: 0 !important;
            position: absolute !important;
            width: 1px !important
        }



        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 28px;
            padding-right: 10px
        }

        .select2-container--default .select2-selection--single,
        .select2-selection .select2-selection--single {
            border: 1px solid #d2d6de;
            border-radius: 0 !important;
            padding: 6px 12px;
            height: 40px !important
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 6px !important;
            right: 1px;
            width: 20px
        }
        .select2-search__field:focus-visible {
            border: 1px solid #e7e7e7;
            outline: none;
        }
        .select2-selection:focus-visible {
            outline: none;
        }
        .select2-dropdown {
            z-index: 1;
        }
        .select2-search--dropdown {
            display: block;
            padding: 4px;
            position: absolute;
            top: -38px;
            width: 100%;
            border: 0px solid #333;
            outline: none;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 0px solid #aaa;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            z-index: 20;
        }
    </style>
@endsection
