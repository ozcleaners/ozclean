@foreach($allBookingService as $item)
    <div class="panel panel-primary">
        <div class="panel-body">
                                         <span class="d-inline-block">
                                            <small>{{$Model('Term')::getColumn($item->service_id, 'name')}}</small> <br>
                                             {{$Model('Term')::getColumn($item->sub_service_id, 'name')}}
                                        </span>
            <span class="float-right">
                                            <a href="{{route('frontend_service_details', $item->id)}}">Edit</a> <br>
                                            {{$item->total_order_amount}}
                                        </span>
        </div>
    </div>
@endforeach


<form action="{{route('frontend_booking_order_store')}}" method="post" class="order_form">
    @csrf
    <input type="hidden" name="hash_code"
           value="{{ $hash_code ?? $general_infos->hash_code }}"/>
    <input type="hidden" name="zone_id" value="{{ $zone_id ?? null }}">
    <input type="hidden" name="general_info_id" value="{{ $general_infos->id ?? NULL }}"/>
    <input type="hidden" name="service_id"
           value="{{ $service_id ?? $general_infos->service_id }}"/>
    <input type="hidden" name="default_price" value="{{ $default_price ?? NULL }}">
    <input type="hidden" name="services[other][default_price][slug]"
           value="default_price"/>
    <input type="hidden" name="services[other][default_price][title]"
           value="Default Price"/>
    <input type="hidden" name="services[other][default_price][base_price]" value="0"/>
    <input type="hidden" name="services[other][default_price][qty]"
           value="1"/>
    <input type="hidden" name="services[other][default_price][amount]"
           value="{{ $default_price ?? NULL }}"/>
    <input type="hidden" name="services[other][default_price][equation_type]"
           value="fixed"/>


    <input type="hidden" name="sub_service_id"
           value="{{ $set_sub_service_id }}"/>
    <div class="panel panel-default">
        <div class="panel-heading p-0">
            <img style="height: 100px;width: 100%; object-fit: cover;"
                 src="https://img.freepik.com/free-photo/hand-holding-variation-object_53876-75673.jpg?w=1380"
                 alt="">
        </div>
        <div class="panel-body">
            <div class="xcalculation_wrap_section">
                <div class="mb-3 text-dark font-weight-bold text-right">
                    <span class="float-left">{{$Model('Term')::getColumn($set_sub_service_id, 'name')}}</span>
                    @php
                        $checklist = explode(' | ', $Model('Term')::getColumn($set_sub_service_id, 'checklist')) ?? false;
                    @endphp
                    @if(!empty($checklist) && $checklist[0])
                        <a target="_blank" href="{{$checklist[1] ?? 'javascript:void(0)'}}" class="btn get_quote_btn">{{$checklist[0] ?? 'Checklist'}}</a>
                    @else
                        &nbsp;
                    @endif
                </div>

                <div class="order_summary">
                    {{--                                                    <ul class="list">--}}

                    {{--                                                    </ul>--}}
                    <div class="calculation_wrap_section">
                        <div class="main ">
                            <div class="mb-3 text-dark accounts_header font-weight-bold"> </div><ul class="list"></ul>
                        </div>

                        <div class="service_amount_total main_total d-none">

                        </div>

                        <div class="extra">
                            <div class="mb-3 text-dark accounts_header font-weight-bold">Extras </div><ul class="list"></ul>
                        </div>
                        <div class="service_amount_total extra_total d-none">

                        </div>
                    </div>
                </div>
            </div>

            <div class="amount_summary  calculation_wrap_section">
                <div class="bt-1 py-2 d-none">
                    Selected Service Amount
                    <div class="float-right d-none">
                        $<span class="sum_service_amount added_item_amount"></span>
                    </div>
                </div>

                <div class="order_summary">
                    {{--                                                    <ul class="list">--}}

                    {{--                                                    </ul>--}}

                    <div class="basic calculation_wrap_section p-0">
                        <div class="mb-3 text-dark accounts_header font-weight-bold"> </div><ul class="list"></ul>
                    </div>
                    <div class="calculation_before_total">
                        <ul class="list mb-0">

                        </ul>
                    </div>
                    <div class="calculation_after_total">
                        <ul class="list mb-0">

                        </ul>
                    </div>
                </div>

            </div>

            <div class="calculation_order_date_time_postcode">
                <ul class="list mb-0">
                    <li class="d-none">
                        Sub Total
                        <div class="float-right d-none">
                            $<span class="sum_sub_total_amount"></span>
                        </div>
                    </li>

                </ul>


                <div class="calculation_wrap_section">
                    <div class="mb-3 text-dark font-weight-bold">Time and Date</div>
                    <ul class="list mb-0">
                        <li class="schedule_date_time">

                        </li>
                    </ul>
                </div>

                <div class="calculation_wrap_section d-none">
                    <div class="mb-3 text-dark font-weight-bold">Address</div>
                    <ul class="list mb-0">
                        <li class="postcode">

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-footer py-1 bg-white">


        </div>
        <div class="panel-footer">
            <div>
                <span class="text total_text">Total</span>
                <input type="hidden" class="input_sum_final_total_amount"
                       name="input_sum_final_total_amount" value="">
                <div class="float-right">
                    $<span class="sum_final_total_amount"></span>
                </div>
            </div>
            <div class="minimum_price_notice text-left text-danger">

            </div>
            <div class="payment_notice mt-2 bg-white p-2 pl-3">

            </div>
        </div>
    </div>

    <div class="d-none add_another_service_wrap">

    </div>



    <div class="d-inline-block">
        <div class="text-left">
            @if(!empty($checklist) && $checklist[0])
                <a target="_blank" href="{{$checklist[1] ?? 'javascript:void(0)'}}" class="btn get_quote_btn">{{$checklist[0] ?? 'Checklist'}}</a>
            @else
            @endif
        </div>
    </div>
    <div class="d-inline-block float-right">
        <div class="text-right">
            <label xfor="email_quote_button" >
{{--                <input type="checkbox" name="get_email_quote" class="w-auto h-auto" style="opacity: 1" id="email_quote_button">--}}
                <input type="submit" style="opacity: 1" name="get_email_quote" id="email_quote_button" class="btn bg_get_quote_btn w-auto h-auto" value="Save Quote" />
            </label>
            <button type="button" class="btn get_quote_btn_2 submit_form go_payment">Next</button>
        </div>
    </div>

</form>
