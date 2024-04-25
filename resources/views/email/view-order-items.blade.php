@php
    $bookingOrderItems = $Model('BookingOrderItem')::where('hash_code', $hash_code)
                        ->orderBy('id', 'asc')
                        ->get()
                        ->groupBy(['service_id', 'sub_service_id', 'accounts_type']);
    //dd($bookingOrderItems);
    $totalServicesAmount = [];
    $bookingInfoMaster = $Model('BookingGeneralInformation')::where('hash_code', $hash_code)->first();
    $get_single_service_id = $get_single_service_id ?? false;

@endphp
@if(count($bookingOrderItems) > 0)
@foreach($bookingOrderItems as $service_id => $breakServiceID)
    <tr>
        <td align="left" class="tdStyle">
            <div class="tdDivStyle" style="font-size: 16px">
                <b> {{$Model('Term')::getColumn($service_id, 'name')}}</b>
            </div>
        </td>
    </tr>

    @foreach($breakServiceID as $sub_service_id => $breakSubServiceID)
        @if($get_single_service_id == $sub_service_id || $get_single_service_id == false)
            <tr>
                <td>
                    <table class="tableStyle" style="margin-bottom: 25px; ">
                        <tbody>
                        <tr style="margin-top: 10px;">
                            <td align="left" class="tdStyle">

                                <div class="tdDivStyle">
                                    <b>{{$Model('Term')::getColumn($sub_service_id, 'name')}}</b>
                                    @if(auth()->user()->hasRoutePermission('oz_order_add_service_item_order'))
                                        @if(isset($add_service_in_order) && $add_service_in_order)

                                                <a href="javascript:void()" type="button"
                                                   data-sub_service_id="{{$sub_service_id}}"
                                                   data-service_id="{{$service_id}}"
                                                   class="calc-open-modal noprint">
                                                    Add service
                                                </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr><!-- Basic Main Item -->
                            <td class="">
                                <table class="tableStyle">
                                    @php
                                        $otherSettings = function($slug, $column) use ($Model, $hash_code, $service_id, $sub_service_id){
                                            $data = $Model('BookingOrderItem')::where('hash_code', $hash_code)
                                                    ->where('service_id', $service_id)
                                                    ->where('sub_service_id', $sub_service_id)
                                                    ->where('service_slug', $slug)->first();
                                            return $data->$column ?? false;
                                        };
                                        $defaultPrice = $otherSettings('default_price', 'service_amount') ?? 0;
                                        $postcodeAmount =  $otherSettings('postcode', 'service_amount') ?? 0;
                                        $scheduleAmount = 0;
                                    @endphp
                                    <tbody>
                                    <tr class="trStyle">
                                        <th align="left" class="tdStyle">&nbsp;</th>
                                        <th align="left" class="tdStyle" style="text-align: right">Total</th>
                                    </tr>

                                    <tr class="">
                                        <td class="tdStyle">

                                            <div class="tdDivStyle">
                                                <b>Schedule:</b>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tdStyle">
                                            <div class="tdDivStyle" style="line-height: 20px;">
                                                @php
                                                    $getSchedule = $otherSettings('schedule_date_time', 'service_title') ?? null;
                                                    $scheduleAmount = $otherSettings('schedule_date_time', 'service_amount') ?? 0;
                                                    $getSchedule = $getSchedule ? json_decode($getSchedule, true) : false;
                                                    $schedulePrice = $otherSettings('schedule_date_time', 'service_base_price') ?? 0;
                                                    $scheduleEquationType = $otherSettings('schedule_date_time', 'service_equation_type') ?? 0;
                                                    $schedulePriceEquation = $scheduleEquationType == 'percentage' ? $schedulePrice.'%' : '$'.$schedulePrice;
                                                    //dump($getSchedule);
                                                @endphp
                                                @if($getSchedule)
                                                    <b>Date:</b> {{$getSchedule['Day']}}, {{$getSchedule['Date']}}
                                                    @if($schedulePrice > 0)
                                                        <div style="padding: 2px 0px; font-size: 12px; font-weight: 600">
                                                            {{$schedulePriceEquation}} Surcharge has been applied.
                                                        </div>
                                                    @else
                                                        <br> <br>
                                                    @endif

                                                    <b>Time:</b> {{$getSchedule['Time']}}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="tdStyle">
                                            <div class="tdDivStyle" style="text-align: right">

{{--                                                ${{$grandTotal []= round( $scheduleAmount > 0 ? ($scheduleAmount /11)*10 : 0 , 2)}}--}}
                                                ${{$grandTotal []= round( $scheduleAmount > 0 ? ($scheduleAmount) : 0 , 2)}}
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" class="tdStyle">
                                            <div class="tdDivStyle">
                                                <b>  Property Details:</b>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $grandTotal = [];
                                        $basicServiceAmount = [];
                                        $mainServiceAmount = [];
                                    @endphp
                                    <tr> <!-- Basic Item and Main Item -->
                                        <td align="left" class="tdStyle">
                                            @php
                                                $basicsServices = $breakSubServiceID['basic'] ?? [];
                                                $mainServices = $breakSubServiceID['main'] ?? [];
                                            @endphp
                                            @if($basicsServices)
                                                <div class="tdDivStyle"> <!-- Basic -->
                                                    @foreach($basicsServices as $key => $item)
                                                        {{$key == 0 ? null : ','}} {!! $item->service_title !!}
                                                        @php $basicServiceAmount []= $item->service_amount @endphp
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if($mainServices)
                                                <div class="tdDivStyle" style="padding-top:5px;">
                                                    @foreach($mainServices as $key => $item)
                                                        {{$key == 0 ? null : ','}} {!! $item->service_qty. ' '. $item->service_title !!}
                                                        @php $mainServiceAmount []= $item->service_amount @endphp


                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>

                                        <td align="left" class="tdStyle" colspan="2">
                                            <div class="tdDivStyle" style="text-align: right">
                                                @php
                                                    $basicMainAmount = array_sum($mainServiceAmount) + array_sum($basicServiceAmount);
                                                    //$postcodeAmount
                                                @endphp

{{--                                                ${{ $grandTotal []= round( ($basicMainAmount + $defaultPrice ) /11*10, 2) }}--}}
                                                ${{ $grandTotal []= round( ($basicMainAmount + $defaultPrice ), 2) }}

                                            </div>
                                        </td>
                                    </tr><!-- End Basic and main Item -->


                                    @php
                                        $extraServiceAmount = [];
                                        $extras = $breakSubServiceID['extra'] ?? [];
                                        $upsell = $breakSubServiceID['upsell'] ?? [];
                                        $upsellServiceAmount = [];
                                        $downsell = $breakSubServiceID['downsell'] ?? [];
                                        $downsellServiceAmount = [];
                                    @endphp
                                    @if($extras)

                                        <tr>
                                            <td class="tdStyle">
                                                <br>
                                                <div class="tdDivStyle">
                                                    <b>Extra Service:</b>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach($extras as $key => $item)
                                            <tr> <!-- Extra Item -->
                                                <td align="left" class="tdStyle" width="80%">
                                                    <div class="tdDivStyle">
                                                        {!! $item->service_qty. ' '. $item->service_title !!}
                                                    </div>
                                                </td>

                                                <td align="left" class="tdStyle" >
                                                    <div class="tdDivStyle" style="text-align: right; margin-right: 35px;">
    {{--                                                    ${{$extraServiceAmount []= round ($item->service_amount /11*10) }}--}}
{{--                                                        ${{ $extraServiceAmount []= round ( $item->service_amount/11 *10, 2) }}--}}
                                                        ${{ $extraServiceAmount []= round ( $item->service_amount, 2) }}
                                                    </div>
                                                </td>


                                            </tr><!-- End Extra Item -->
                                        @endforeach
                                        <tr style="border-top: 1px solid #ecedee;">
                                            <td></td>

                                            <td align="left" class="tdStyle" >
                                                <div class="tdDivStyle" style="text-align: right">
                                                    ${{$grandTotal []=  round( array_sum($extraServiceAmount) ,2 )  }}
                                                </div>
                                            </td>
                                        </tr><!-- End Extra Item -->
                                    @endif

                                    @if($upsell || $downsell)
                                        <tr>
                                            <td class="tdStyle">
                                                <br>
                                                <div class="tdDivStyle">
                                                    <b>Additional Service:</b>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($upsell)


                                        @foreach($upsell as $key => $item)
                                            <tr> <!-- Extra Item -->
                                                <td align="left" class="tdStyle" width="80%">
                                                    <div class="tdDivStyle">
{{--                                                        {!! $item->service_qty. ' '. $item->service_title !!}--}}
                                                        {!!  $item->service_title !!}
                                                    </div>
                                                </td>

                                                <td align="left" class="tdStyle" >
                                                    <div class="tdDivStyle" style="text-align: right; margin-right: 35px;">
{{--                                                        ${{ $upsellServiceAmount []= round ( $item->service_amount/11 *10, 2) }}--}}
                                                        ${{ $upsellServiceAmount []= round ( $item->service_amount, 2) }}

                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                        <tr style="border-top: 1px solid #ecedee;">
                                            <td></td>

                                            <td align="left" class="tdStyle" >
                                                <div class="tdDivStyle" style="text-align: right">
                                                    @php $grandTotal []=  round( array_sum($upsellServiceAmount) ,2 )  @endphp
                                                    {{round( array_sum($upsellServiceAmount) ,2 ) }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endif


                                    @if($downsell)


                                        @foreach($downsell as $key => $item)
                                            <tr> <!-- Extra Item -->
                                                <td align="left" class="tdStyle" width="80%">
                                                    <div class="tdDivStyle">
{{--                                                        {!! $item->service_qty. ' '. $item->service_title !!}--}}
                                                        {!!  $item->service_title !!}
                                                    </div>
                                                </td>

                                                <td align="left" class="tdStyle">
                                                    <div class="tdDivStyle" style="text-align: right; margin-right: 0px;">
{{--                                                        -${{ $downsellServiceAmount []= round ( $item->service_amount/11 *10, 2) }}--}}
                                                        -${{ $downsellServiceAmount []= round ( $item->service_amount, 2) }}
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                        <tr style="border-top: 0px solid #ecedee;">
                                            <td></td>

                                            <td align="left" class="tdStyle" >
                                                <div class="tdDivStyle" style="text-align: right">
                                                    @php $discount []=  round( array_sum($upsellServiceAmount) ,2 ) @endphp
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                    @php
                                        //$discount = $Model('BookingOrderPayment')::where('hash_code', $hash_code)
                                                    // ->where('account_type', 'Discount')->where('')->sum('amount') ?? 0.00
                                        $discount = array_sum($downsellServiceAmount);

                                    @endphp

                                    <tr class="" style="border-top: 1px solid #ecedee;">
                                        @if($discount > 0)
                                            <td class="tdStyle">
                                                <div class="tdDivStyle">
                                                    <b>Discount</b>
                                                </div>
                                            </td>
                                            <td class="tdStyle">
                                                <div class="tdDivStyle" style="text-align: right">
                                                -${{ $discount =  round($discount ,2) }}
                                                </div>
                                            </td>
                                        @endif
                                    </tr>

                                    <tr class="" style="border-top: 0px solid #ecedee;">
                                        <td class="tdStyle">
                                            <div class="tdDivStyle">
                                                <b>Sub Total</b>
                                            </div>
                                        </td>
                                        <td class="tdStyle">
                                            <div class="tdDivStyle" style="text-align: right">
                                                <b>${{ $subTotal = round(round(array_sum($grandTotal) - $discount, 2) /11*10, 2) }}</b>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="" style="border-top: 0px solid #ecedee;">
                                        <td class="tdStyle">
                                            <div class="tdDivStyle">
                                                <b>GST (10%)</b>
                                            </div>
                                        </td>
                                        <td class="tdStyle">
                                            <div class="tdDivStyle" style="text-align: right">

                                                <b>${{ $gst= round($subTotal*10/100, 2) }}</b>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="" style="border-top: 1px solid #ecedee;">
                                        <td class="tdStyle">
                                            <div class="tdDivStyle">
                                                <b>Grand Total</b>
                                            </div>
                                        </td>
                                        <td class="tdStyle">
                                            <div class="tdDivStyle" style="text-align: right">
                                                <b>${{$totalServicesAmount []= ceil($subTotal + $gst)}}</b>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr> <!-- Basic Main Item -->
                        </tbody>
                    </table>
                </td>
            </tr>
        @endif

    @endforeach <!-- sub service Loop -->
@endforeach <!-- service Loop -->

<tr class="" style="border-top: 3px solid #203647;">

    <td class="tdStyle">
        <div class="tdDivStyle" style="display: inline-block">
            <b>Total Services Amount</b>
        </div>
        <div class="tdDivStyle" style="text-align: right; display: inline-block; float: right">
            <b>${{$totalServicesAmount = array_sum($totalServicesAmount)}}</b>
        </div>
    </td>
</tr>

<tr class="" style="border-top: 0px solid #203647;">

    <td class="tdStyle">
        <div class="tdDivStyle" style="display: inline-block">
            <b>Diposited</b>
        </div>
        <div class="tdDivStyle" style="text-align: right; display: inline-block; float: right">
            <b>
                ${{$paidAmount = round($Model('BookingOrderPayment')::getPaidAmount($bookingInfoMaster->id))}}
            </b>
        </div>
    </td>
</tr>

<tr class="" style="border-top: 0px solid #203647;">

    <td class="tdStyle">
        <div class="tdDivStyle" style="display: inline-block">
            <b>Amount Due</b>
        </div>
        <div class="tdDivStyle" style="text-align: right; display: inline-block; float: right">
{{--            <b>${{round($Model('BookingOrderPayment')::getDueAmount($bookingInfoMaster->id))}}</b>--}}
            <b>${{$totalServicesAmount-$paidAmount}}</b>
        </div>
    </td>
</tr>


@else
<tr>
    <td align="left" class="tdStyle">
        <div class="tdDivStyle" style="font-size: 16px">
            <b>{{$Model('Term')::getColumn($bookingInfoMaster->service_id, 'name')}}</b> <br>
        </div>
    </td>
</tr>
<tr>
    <td align="left" class="tdStyle">
        <div class="tdDivStyle" style="font-size: 16px">
            {{$Model('Term')::getColumn($bookingInfoMaster->sub_service_id, 'name')}}
        </div>
    </td>
</tr>
@endif
