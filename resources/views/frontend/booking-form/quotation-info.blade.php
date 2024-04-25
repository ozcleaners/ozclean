@extends('frontend.layouts.master')

@section('metas')
    <title>OZ Cleaners | Find the price for your service</title>
    <meta name="description" content="For your required cleaning service, select the options bellow to get a quote and find the availability">
    <meta name="keywords" content="Residential cleaning, Commercial cleaning, Exterior cleaning, Interior cleaning, End of Lease Cleaning, Window cleaning, Solar panel cleaning, Strata Cleaning, High pressure cleaning, After builders cleaning, Renovation cleaning, Gutter cleaning, carpet steam cleaning, oven cleaning, BBQ cleaning, Spring cleaning, Regular house cleaning, Regular office cleaning, roof cleaning, roof painting">
    <link href="https://ozcleaners.com.au/service_details" rel="canonical">
    <meta name="author" content="Oz Cleaners">
    <meta name="zone" content="Australia">
@endsection


@section('content')

    <div class="row m-0 justify-content-center">
        <div class="containerx col-xl-10 col-lg-12 mt-5">
{{--            <div class="mobile-top-spacer"></div>--}}
            <div class="section-heading">
                <div class="heading-with-icon-wrap px-3">
                    <div class="heading-with-icon-inner section-name-text">
                        <div class="heading-icon"></div>
                        Online Quote
                    </div>
                </div>

{{--                <h3 class="contact-info-content-title st-default quote-text-summary">--}}
{{--                    <span class="">Submit following information to get an instant quote</span>--}}
{{--                </h3>--}}
            </div>
            @if(!empty($general_infos))
                @php
                    if(!empty($service_id) && !empty($sub_service_id)) {
                         $set_service_id = $service_id;
                         $set_sub_service_id = $sub_service_id;
                    }else{
                        $set_service_id = $general_infos->service_id;
                        $set_sub_service_id = $general_infos->sub_service_id;
                    }
                    $minimumPriceID = $Model('AttributeValue')::where('slug', 'minimum_price')
                                        ->where('unique_name', 'Calculator Setting')
                                        ->first();
                    if($minimumPriceID){
                        $minimumPrice = $Model('CalcBasicSetting')::where('service_id', $set_sub_service_id)
                                            ->where('setting_type', $minimumPriceID->id)->first()->rate ?? 0;
                    }
                @endphp
                <div class="row px-3 d-none">
                    <div class="col-lg-6 col-md-6">
                        <strong>Name: </strong>
                        {{ $general_infos->full_name ?? NULL }}
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <strong>Email: </strong>
                        {{ $general_infos->email_address ?? NULL }}
                    </div>

                </div>
                <div class="row px-3 d-none">
                    <div class=" col-lg-6 col-md-6">
                        <strong>Contact: </strong>
                        {{ $general_infos->contact_no ?? NULL }}
                    </div>
                    <div class=" col-lg-6 col-md-6">
                        <strong>Postcode: </strong>
                        {{ $postCode =  $general_infos->post_code ?? NULL }}
                        @php
                            $postCodeRate =$Model('PostcodeRate')::with('getEquationType')
                                             ->where('postcode', $postCode)
                                            ->where('service_id', $set_sub_service_id)
                                            ->first();
                            $getServiceItem = function($slug, $column) use($Model, $general_infos, $set_sub_service_id){
                                $data = $Model('BookingOrderItem')::where('hash_code', $general_infos->hash_code)
                       						->where('sub_service_id', $set_sub_service_id)
                                          ->where('service_slug', $slug)
                                          ->first();
                                return $data->$column ?? null;
                        };
                        //dump();
                        @endphp
                    </div>
                </div>
                <div class="row px-3">
                    <div class="col-lg-6 col-md-6">
                        <strong>Service: </strong>
                        {{$Model('Term')::getColumn($set_service_id, 'name')}} - {{$Model('Term')::getColumn($set_sub_service_id, 'name')}}

                        @if($alternative_name = $Model('Term')::getColumn($set_sub_service_id, 'alternative_name'))
                            (<div class="d-inline-block">

                            @foreach(explode(' | ', $alternative_name) as $key =>  $name)
                              {{$key != 0 ? ',' : null}} {{$name}}
                            @endforeach
                            </div>)
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div style="    border-top: 1px solid #f4f4f4;margin: 10px 0px;"></div>
                    </div>
                </div>

                @if(request()->get('param-sd'))
                    @include('frontend.booking-form.calculator-template.service_details')
                @else
                    <div class="row calculator_form_wrapper_row">

                        <div class="col-xl-8 col-lg-9 col-md-12">

                            <form action="" method="post">
                                <div class="calculator_form">
                                    @php
                                        $zone_id = $Model('Postcode')::where('postcode', $general_infos->post_code)->first()->zone_id ?? NULL;
                                        $basicSettingRawAmounts = $Model('CalcBasicSetting')::with('equationType')->where('service_id', $set_sub_service_id)
                                                                    ->where('show_on_calculator', 'No')
                                                                    ->where('computable', 'Yes');

                                        $default_price = $basicSettingRawAmounts->where('setting_type', 25)->first()->rate ?? 0;

                                        $basicSetting = $Model('CalcBasicSetting')::with('equationType')
                                                                    ->where('service_id', $set_sub_service_id)
                                                                    ->where('show_on_calculator', 'Yes')
                                                                    ->where('computable', 'Yes')
                                                                    ->where('which_module', '=', 'Basic')
                                                                    ->orderBy('sorting_order', 'ASC')
                                                                    ->orderBy('calculate_with', 'DESC')
                                                                    ->get()->groupBy('setting_type');
                                        $mainServiceSetting = $Model('CalcServiceSetting')::where('service_id', $set_sub_service_id)
                                            ->where('setting_option_type', 34)
                                            ->orderBy('setting_option_type', 'ASC')
                                            ->orderBy('sorting_order', 'ASC')
                                            ->get();
                                  	//dump($mainServiceSetting);
                                        $extraServiceSetting = $Model('CalcServiceSetting')::where('service_id', $set_sub_service_id)
                                        ->where('setting_option_type', 35)
                                        ->orderBy('setting_option_type', 'ASC')
                                        ->orderBy('sorting_order', 'ASC')
                                        ->get();


                                     $calculator_template = $Model('Term')::getColumn($set_sub_service_id, 'calculator_template');
                                    @endphp

                                    @if($calculator_template == 'regular')
                                        @include('frontend.booking-form.calculator-template.regular')
                                    @elseif($calculator_template == 'breakdown')
                                        @include('frontend.booking-form.calculator-template.breakdown')
                                    @endif



                                    @include('frontend.booking-form.schedule')

                                </div>
                                <div class="row d-none">
                                    <div class="col-lg-2 col-md-3">
                                        <div class="form-field-wrap">
                                            <button type="submit" class="contact-form-submit-button btn">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="xpanel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 show_this_click d-none">
                                            <span class="form-field-wrap">
                                                @php
                                                    $services = $Model('Term')::where('parent', 3)->get();
                                                @endphp
                                                <select name="term_parent" id="term_no_get"
                                                        class="xform-control contact-form-wrap-control">
                                                    <option value="">Select Service Group</option>
                                                    @foreach($services as $key => $value)
                                                        <option
                                                            value="{{ $value->id ?? NULL }}">{{ $value->name ?? NULL }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                        <div class="col-lg-4 col-md-4 show_this_click">
                                                <span class="form-field-wrap">
                                                    <select name="sub_term_id" id="level_no_get"
                                                            class="form-control contact-form-wrap-control">
                                                        <option>Select a parent...</option>
                                                    </select>
                                                    <div class="sub_term_errormsg text-center text-danger" style="display: none">Please select a service</div>
                                                </span>
                                            {{--                                            <div id="level_no_get" clas="py-3"></div>--}}
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <div class="justify-right">
                                                <button type="buuton" data-face="add" style="border-width: 2px;"
                                                        class="btn btn-success btn-md add_another_service btn_radius">
                                                    Add Another Service
                                                </button>
                                                <div class="next_process" style="display: none;">
                                                    <button type="button"  class="btn get_quote_btn_2 submit_form add_another_form_submit">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-3 calculator-body ">

                            @php
                                $allBookingService = $Model('BookingGeneralInformation')::where('hash_code' , $general_infos->hash_code)
                                                    ->whereNotIn('id',  [$general_infos->id])
                                                    ->get();
                            @endphp
                            @include('frontend.booking-form.show-calculator')
                        </div>
                    </div>
            @endif

        @endif

        @include('frontend.booking-form.calc-modal')

        </div>
    </div>
    <div class=" d-block d-lg-none">
        <div class="mobile-price-cls">
           <p>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span id="mobile-proce-v"></span>
            </p>
        </div>
    </div>
@endsection

@section('cusjs')

    @include('frontend.booking-form.calculator-js')

    <script>
        jQuery(document).ready(function ($) {
            $.noConflict();
            $('#term_no_get').ready(function () {
                let term_id = $(this).val();

                //let url = "{{ route( 'frontend_sub_terms_getter', '')  }}/" + term_id;
                let url = "{{ route( 'frontend_sub_terms_getter', '')  }}/{{$set_service_id ?? null}}?hash_code={{$general_infos->hash_code}}&&set_sub_service_id={{$set_sub_service_id}}";

                $.get(url, function (data, status) {
                    $('#level_no_get').html(data.html);
                });
            });
            $('.add_another_service').click(function () {
                let btnFace = $(this).data('face');
                if (btnFace == 'add') {
                    $('.show_this_click').attr('style', 'display:inline')
                    $(this).data('face', 'remove')
                    $(this).text('Remove')
                    $('.next_process').attr('style', 'display: inline-block')
                    $('.submit_form.go_payment').hide()
                } else {
                    $('.add_another_service_wrap').html(null)
                    $('.show_this_click').attr('style', 'display:none')
                    $(this).data('face', 'add')
                    $(this).text('Add another service')
                    $('.next_process').hide()
                    $('.submit_form.go_payment').show()
                }
            })

            //Selected Term

            $('select#level_no_get').change(function () {
                let ct = $(this).find(':selected').val();
                ct == 'Select a Service' ? '' : $('.sub_term_errormsg').hide() + $('#level_no_get').removeClass('border-danger')
                let pt = $('select#term_no_get').find(':selected').val();
                let html = `
                    <input type="hidden" name="add_another_service[service_id]" value="${pt}">
                    <input type="hidden" name="add_another_service[sub_service_id]" value="${ct}">
                `
                $('.add_another_service_wrap').html(html)
            })
        });
    </script>
    <style>
        .show_this_click {
            display: none;
        }

        .panel {
            -webkit-box-shadow: 0px 0px 3px rgb(0 0 0 / 16%);
            box-shadow: 0px 0px 3px rgb(0 0 0 / 16%);
            border: 0px solid transparent;
        }

        .panel-heading {
            background-image: none !important;
            border-bottom: 0px solid transparent;
        }


        .calculation_wrap_section{
            background: #f3f3f3;
            padding: 10px 20px;
            margin-bottom: 10px;
        }
        .mobile-price-cls {
            width: 70px;
            height: 70px;
            background: #00A9FB;
            text-align: center;
            border-radius: 50%;
            color: #FFF;
            font-weight: bold;
            display: table;
            position: fixed;
            bottom: 128px;
            right: 0px;
            z-index: 11111;
            border: 3px solid #FFF;
            line-height: 23px;
            font-size: 13px;
        }
        .mobile-price-cls p {
            display: table-cell;
            vertical-align: middle;
        }
        .mobile-price-cls i.fa.fa-shopping-cart {
            display: block;
            font-size: 13px;
        }
    </style>
@endsection

@section('bottomcusjs')
@endsection
