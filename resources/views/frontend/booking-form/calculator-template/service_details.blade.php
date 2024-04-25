@php
$minimumBookingAmountAsPercentage = $Query::frontendSettings('minimum_booking_amount_as_percentage') ?? 20;
@endphp

<form action="{{route('frontend_checkout_credit_card')}}" method="post" id="payment-form">
    @csrf
    <div class="row">
        <div class="col-xl-8 col-lg-9">
            <div class="shaded_area px-3">
                <div class="row">
                    <div class="col-md-4 col-sm-4col-xs-12">
                        <div class="form-group">
                            <label for="email" class="sub_title">Email Address</label>
                            <input class="form-control" id="user_email" placeholder="Enter Email Address" readonly=""
                                   name="email"
                                   type="text" value="{{$general_infos->email_address}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="form-group" id="password_option">
                            <label for="password" style="white-space: nowrap" class="password">Create Password (Optional)</label>
                            <input class="form-control" id="password" placeholder="Min 6 characters" name="password"
                                   type="password"
                                   value="">
                        </div>
                        <small>Create password and track your services later.</small>
                    </div>

                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="form-group">
                            <label for="phone" class="unit_no">Phone</label>

                            <input required="" class="form-control" name="phone" type="text"
                                   value="{{$general_infos->contact_no}}"
                                   id="phone">
                        </div>
                    </div>
                </div>
            </div>
            <div class="shaded_area px-3">
                <div class="shaded_area">

                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="address" class="addresss">Street Address</label>
                                <input required id="formatted_address" class="form-control geocomplete"
                                       placeholder="Enter Address" autocomplete="off" name="address" type="text">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-6">
                            <div class="form-group">
                                <label for="unit_no" class="unit_no">Unit No.</label>

                                <input required="" class="form-control" readonly="" name="unit_no" type="text"
                                       value="House"
                                       id="unit_no">
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-4 col-6">
                            <div class="form-group">
                                <label for="locality" class="addresss">Suburb</label>
                                <input required id="locality" class="form-control" placeholder="Enter Suburb"
                                       name="suburb"
                                       type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-6">
                            <div class="form-group">
                                <label for="locality" class="addresss">State</label>
                                <input required id="administrative_area_level_1" class="form-control"
                                       placeholder="Enter State"
                                       name="state" type="text">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-6">
                            <div class="form-group">
                                <label for="locality" class="addresss">Postcode</label>
                                <input required id="postal_code" class="form-control" placeholder="Enter Zip"
                                       name="post_code"
                                       type="text" value="{{ $general_infos->post_code ?? NULL }}">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="shaded_area">

                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                    <label for="parking_instructions" class="parking_instructions">
                                        Parking Instructions
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="form-inlin">
                                        <div class="col-xs-4 col-md-12 col-sm-12 arfoi">
                                            <div class="radio">
                                                <label>

                                                    <input required class="radio" checked="checked" data-placeholder=""
                                                           name="parking_instructions" type="radio" value="1"
                                                           id="parking_instructions">
                                                    Garage/Driveway
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-12 col-sm-12 arfoi">
                                            <div class="radio">
                                                <label style="margin-bottom: 0">
                                                    <input required class="radio"
                                                           data-placeholder="Any Parking fee - Customer will pay"
                                                           name="parking_instructions" type="radio" value="3"
                                                           id="parking_instructions">
                                                    Street Parking
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-12 col-sm-12 arfoi">
                                            <div class="radio">
                                                <label style="margin-bottom: 0">
                                                    <input required class="radio"
                                                           data-placeholder="Any Parking fee - Customer will pay"
                                                           name="parking_instructions" type="radio" value="4"
                                                           id="parking_instructions">
                                                    Paid Parking <small style="font-size: 12px;" class="text-danger"> (Customer will pay)</small>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 p-0">
                                    <label for="property_access" class="property_access">Property Access</label>
                                </div>
                                <div class="row">
                                    <div class="form-inlin">
                                        <div class="col-xs-4 col-md-12 col-sm-12 arfoi">
                                            <div class="radio">
                                                <label>
                                                    <input required class="radio"
                                                           data-placeholder="Enter  Will be home Access Notes"
                                                           checked="checked" name="property_access" type="radio"
                                                           value="1"
                                                           id="property_access">
                                                    Will be at home
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-12 col-sm-12 arfoi">
                                            <div class="radio">
                                                <label>
                                                    <input required class="radio"
                                                           data-placeholder="Enter Leaving Key Access Notes"
                                                           name="property_access" type="radio" value="2"
                                                           id="property_access">
                                                    Leaving Key
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-12 col-sm-12 arfoi">
                                            <div class="radio">
                                                <label>
                                                    <input required class="radio" data-placeholder="Enter Other Access Notes"
                                                           name="property_access" type="radio" value="3"
                                                           id="property_access">
                                                    Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <label for="property_access" class="property_access hidden-sm hidden-xs">&nbsp;</label>
                            <textarea rows="4" class="form-control" placeholder="Enter Access Notes" id="access_notes"
                                      name="access_notes" cols="50"></textarea>
                        </div>
                    </div>

                </div>




            </div>
        </div>
        <div class="col-xl-4 col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Order Summary
                </div>
                <div class="panel-body">
                    @php
                        $allBookingService = $Model('BookingOrderItem')::where('hash_code', request()->id)->get()->groupBy('sub_service_id')->toArray();
                        //dd($allBookingService);
                        $services_amount = [];
                        $booking_ids = [];
                        $booking_dates = [];
                    @endphp


                    @php
                        $services_amount = array();
                        $payable_amount = [];
                    @endphp
                    @foreach($allBookingService as $key => $item)
{{--                                            @dd($item)--}}
                        <div class="panel panel-primary">
                            <div class="panel-body">
                         <span class="d-inline-block">
                             {{ $Model('Term')::getColumn($key, 'name') }} <br>
                            <small>
                                of {{ $Model('Term')::getColumn($item[0]['service_id'], 'name') }}
                            </small>
                             <br>
                             <small>
                                @php
                                  $scDate =  $item[1]['service_title'] ?? null;
                                  $scDate = json_decode($scDate);
                                @endphp
                                    {{$scDate->Time }} <br>
                                  {{$scDate->Day }},  {{$booking_dates []=$scDate->Date }}
                             </small>

                        </span>
                                @php
                                    $sum = array_sum(array_map(function($arr) {
                                        return $arr['service_amount'];
                                    }, $item));
                                @endphp
                                <span class="float-right text-right">
                            <a href="{{route('frontend_service_details', $item[0]['hash_code']) }}?service_id={{ $item[0]['service_id'] }}&sub_service_id={{ $item[0]['sub_service_id'] }}">Edit</a> <br>

                                    @php
                                        $minimumPrice = $Model('CalcBasicSetting')::where('service_id', $key)
                                             ->where('setting_type', $minimumPriceID->id)->first()->rate ?? 0;
                                        $service_payable = $minimumPrice > $sum ? $minimumPrice : $sum;
                                    @endphp

                                     ${{ $service_amount [] = ceil($service_payable)  }} <br>
                                   <small> <strong>Payable Now: ${{ $payable_amount []= ceil(($service_payable*$minimumBookingAmountAsPercentage)/100) }}</strong></small>
                        </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="panel-footer text-center">
                    @php
                        //$bookingDate =  $general_infos->created_at->format('d M Y');
                         //var_dump($booking_dates);
                        $bookingDate = date('d M Y', min(array_map('strtotime', $booking_dates)));
                        $bookingDate = date('d M Y', strtotime($bookingDate. ' -1 day'));
                    @endphp
                    Deposit <b>${{(float)array_sum($payable_amount)}}</b>
                    now to confirm the booking.
{{--                    Balance should be paid by <b>{{$bookingDate}}</b>.--}}
                </div>


            </div>

            <div class="">
                <label for="tos">
                    <input required type="checkbox" name="" id="tos"  class="form-control w-auto h-auto d-inline-block" style="position: unset; opacity: unset">
                    I have read and agree to the <a target="_blank" href="{{url('/page/terms-and-conditions')}}">Terms & Conditions</a>
                </label>
            </div>

            @php
                //$stripe_secret_key = 'sk_test_51L9MpOGL7xLECUD7T1NVf1nofbrmPmgbzBmL7foOjiJeJl0w1BDze38fdmRXNgYbraIJXPcv9TqdMpyj75MnKHVJ00JlcPbkyl';
                //$stripe_public_key = 'pk_test_51L9MpOGL7xLECUD7CYPE9X4FMFRReG4MshS2TXJ4WbwDtLxhyTPiT1fiewXkgc9QjgDYh58Y92CMiM2gTbpvLKfD00Jz1AFVSV';
                //\Stripe\Stripe::setApiKey($stripe_secret_key);
                $amount = (float) array_sum($service_amount);
               /** $payment_intent = \Stripe\PaymentIntent::create([
                    * 'description' => 'Stripe Test Payment',
                    * 'amount' => $amount,
                    * 'currency' => 'USD',
                    * 'description' => 'Payment From Test',
                    * 'payment_method_types' => ['card'],
                    * //'booking_id' => implode(',', $booking_ids),
                * ]);
                * $intent = $payment_intent->client_secret; **/
            @endphp

            <input type="hidden" name="total_amount" value="{{$amount}}">
            <input type="hidden" value="{{ request()->id }}" name="hash_code"/>
            <input type="hidden" value="{{ ($amount  * $minimumBookingAmountAsPercentage) / 100 }}" name="payable_amount"/>
            <div class="uc_fake_strip_btn">
{{--                <button class="stripe-button-el pull-right">--}}
{{--                    <span style="min-height: 30px;">Pay Now</span>--}}
{{--                </button>--}}
{{--                //"pk_test_7GebVn5WVWokOa3ZOHdEjzI600tSWTSRr6"--}}
            </div>

        <div class="tos_no_agree">
            <button class="stripe-button-el" type="submit">
                <span style="display: block; min-height: 30px;">Deposit Now</span>
            </button>
        </div>
         <div class="stripe_do" style="display: none">
             <script

                 src="https://checkout.stripe.com/checkout.js"
                 class="stripe-button"
                 data-key= "{{ $Query::frontendSettings('stripe_publisher_key') }}"
                 data-amount="{{ ($amount * 100) * $minimumBookingAmountAsPercentage / 100  }}"
                 data-name="{{$minimumBookingAmountAsPercentage}}% of subtotal ${{ $amount }}"
                 data-email="booking@ozcleaners.com.au"
                 data-label="Deposit Now"
                 data-allow-remember-me="false"
                 data-description="OZCleaners"
                 data-image="{{ $Media::fullSize(get_global_setting('favicon')) }}"
                 data-locale="auto"
                 data-currency="aud">
             </script>
         </div>




        </div>
    </div>

</form>

@section('cusjs')
    @parent
<script>
    jQuery(document).ready(function($) {
        $('#payment-form').on('change', '#property_access', function () {
            let id = $(this).val()
            if(id ==1){
                $('textarea#access_notes').attr('required', false)
            }else {
                $('textarea#access_notes').attr('required', true)
            }
        })


        $('form#payment-form button.stripe-button-el').click(function(e){
            if($('input#tos').is(':checked')){

            }else {
                //alert('Please check the tos')
            }
        })

        $('input#tos').click(function (){
            if($(this).is(':checked')){
                $('.tos_no_agree').hide();
                $('.stripe_do').show();
            }else {
                $('.tos_no_agree').show();
                $('.stripe_do').hide();
            }
            // if($(this).attr(':checked'))
        })

    })
</script>
    <style>
        .stripe-button-el{
            float: right;
        }
    </style>

@endsection
