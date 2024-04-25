@php

    $working_days = $Model('ScheduleManager')::where('service_id', $set_sub_service_id)
                                ->where('zone_id', $zone_id)->groupBy('date')->get();

    $available_starting_times = $Model('ScheduleManager')::where('service_id', $set_sub_service_id)
                                ->where('zone_id', $zone_id)
                                ->where('date', '2022-06-03')
                                ->groupBy('from_hour', 'within_hour')
                                ->get();

    $schedule_date_time = $getServiceItem('schedule_date_time', 'service_title');
    $schedule_date_time_amount = $getServiceItem('schedule_date_time', 'service_base_price') ?? 0;
    $schedule_date_time_equation_type = $getServiceItem('schedule_date_time', 'service_equation_type');
    $getScheduleDate = json_decode($schedule_date_time);
    $ScheduleTime = $getScheduleDate->Time ?? null;
    $ScheduleDay = $getScheduleDate->Day ?? null;
    $ScheduleTimeId = $getScheduleDate->TimeId ?? null;
    $bookDayAfterDays = $Model('TermZoneOtherSetting')::getValue($set_sub_service_id,$zone_id, 'book_day_after_days') ?? 2;
@endphp

<div class="panel panel-default schedule_date_time mt-4">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="schedule_date">
                        <img src="{{ URL::asset('public/frontend/img/faq/pick_a_date.png') }}" style="width: 45px;"/>
                        Pick a Date
                    </label>
                    <input id="schedule_date" type="text"
                           class="xform-control xform-control-sm contact-form-wrap-control  schedule-date"
                           value="{{$getScheduleDate->Date ?? null}}" data-rate="{{$schedule_date_time_amount}}" data-equation_type="{{$schedule_date_time_equation_type}}"  placeholder="Select date" autocomplete="off">
                    <div class="schedule_date_offer text-success ml-3 font-weight-bold">
                        <small class="font-weight-bold">For today or tomorrow booking, please contact us.</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">
                        <img src="{{ URL::asset('public/frontend/img/faq/pick_a_time.png') }}" style="width: 45px;"/>
                        Select start time
                    </label>
                    <select name="" class="xform-control contact-form-wrap-control schedule_time">
                        {{--                       @foreach($available_starting_times as $k => $v)--}}
                        {{--                           <option>{{ $v->from_hour }} - {{ $v->within_hour }} ( 2 teams available )</option>--}}
                        {{--                       @endforeach--}}
                    </select>
                    <div class="schedule_time_errormsg text-center text-danger" style="display: none">Please select a time</div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--    <!-- Schedule -->--}}

{{--<select name="">--}}
{{--    @foreach($working_days as $k => $v)--}}
{{--        <option>{{ $v->date }} </option>--}}
{{--    @endforeach--}}
{{--</select>--}}





@section('cusjs')
    @parent

    <script>
        jQuery(document).ready(function ($) {
            $('.schedule-date').datepicker({
                // beforeShowDay: checkoutdisableddays,
                minDate: '+{{$bookDayAfterDays}}',
                dateFormat: 'yy-mm-dd'
            });



            function scheduleAjax(getDate) {
                $.ajax({
                    method: "GET",
                    url: "{{route('frontend_booking_schedule_time')}}",
                    data: {
                        'get_date': getDate,
                        'zone_id': "{{$zone_id}}",
                        'sub_service_id': "{{$set_sub_service_id}}",
                    },
                    _token: "{{csrf_token()}}",
                    success: function (r) {
                        let getDateRate = r.equation_type == 'percentage' ? r.rate+'%' : '$'+r.rate;
                        scheduleDateOffer = r.rate == 0 ? '' : getDateRate+' Surcharge has been applied.';

                        //If have any offer in the selected schedule date

                        $('.schedule_date_offer').html(scheduleDateOffer);

                        let html = "<option selected disabled>Select a time</option>";
                        let times = r.times;
                        let rate = r.rate ?? 0;
                        let getDay = r.day;
                        // let selected =  getDay == '';
                        let equationType = r.equation_type ?? null;
                        //console.log(rate)

                        for (var i = 0; i < r.times.length; i++) {
                            let selected = times[i].id == "{{$ScheduleTimeId}}" ? 'selected' : '';
                            //let storeRate = times[i].id == "{{$ScheduleTimeId ?? false}}" ? localStorage.setItem('schedule_rate', rate) : null;
                            html += `<option data-id="${times[i].id}" ${selected} data-day="${getDay}" data-rate="${rate}" data-equation_type="${equationType}">${times[i].from_hour} - ${times[i].within_hour}</option>`;
                        }
                        // console.log(html)
                        $('.schedule_date_time select.schedule_time').html(html)
                    },

                })//End Ajax
            }

            $('.schedule-date').on('change', function () {
                // alert($(this).val())
                let getDate = $(this).val();
                //console.log(3)
                scheduleAjax(getDate);
            })

            //Onfly
            let selectedScheduleDate = $('.schedule-date').val();
            if (selectedScheduleDate) {
                scheduleAjax(selectedScheduleDate)
            } else {
                //localStorage.setItem('schedule_rate', null);
            }


        })

    </script>


@endsection
