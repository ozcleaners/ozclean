@extends('frontend.layouts.master')
@section('content')
    <div class="row m-0 justify-content-center">
        <div class="col-lg-10 mt-5">
            <div class="row">
                @include('frontend.user.profile_menu')
                <div class="col-lg-10">
                    @php
                        //dump(auth()->user()->id);
                        $orders =  $Model('BookingOrderItem')::where('auth_user_id', auth()->user()->id)->get()->groupBy('general_info_id');
                        //dump($orders);
                    @endphp

                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Payment Status</th>
                            <th>Payment Through</th>
                            <th>Total Payable Amount</th>
                            <th>Total Paid Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $key => $order)
                            @php
                                $payment =  $Model('BookingOrderPayment')::where('general_info_id', $key)->orderBy('id', 'desc')
                                        ->where('account_type', 'Received')
                                        ->first();
                                $bookingGeneralInfo = $Model('BookingGeneralInformation')::where('id', $key)->first();
                            @endphp
                            <tr>
                                <td>
                                    {{$bookingGeneralInfo->created_at->format('Y-m-d')}}
                                </td>

                                <td>
                                    {{$payment->payment_status ?? null}}
                                </td>
                                <td>
                                    {{$payment->payment_media ?? null}}
                                </td>
                                <td>
                                    {{
                                    $Model('BookingOrderPayment')::where('general_info_id', $key)
                                                        ->where('account_type', 'Receivable')
                                                        ->get()->sum('amount')-
                                                           $Model('BookingOrderPayment')::where('general_info_id', $key)
                                                        ->where('account_type', 'Discount')
                                                        ->get()->sum('amount')
                                                        }}
                                </td>
                                <td>
                                    {{$Model('BookingOrderPayment')::where('general_info_id', $key)
                                        ->where('account_type', 'Received')
                                        ->get()->sum('amount')}}
                                </td>
                                <td>
                                    <a href="{{route('frontend_user_order', $bookingGeneralInfo->hash_code)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
