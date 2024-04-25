@extends('admin.layouts.master')

@section('title')
    Manage Groupwise Orders
@endsection

@section('filter')
    <div>
        <form action="{{request()->url()}}" method="GET">
            @php
                $paginate = [10, 30, 50, 100];
            @endphp
           <span style="white-space: nowrap">Show As:</span>
            <select name="show_as_paginate" style="width: 80px;">
                @foreach($paginate as $p)
                    <option value="{{$p}}" {{request()->show_as_paginate ==  $p ? 'selected' : null}}>{{$p}}</option>
                @endforeach
            </select>
            @php
                $orderStatus = $Query::getEnumValues('booking_general_information', 'order_status');
            @endphp

            <select name="order_status">
                <option value="">Select Order Status</option>
                @foreach($orderStatus as $p)
                    <option value="{{$p}}" {{request()->order_status ==  $p ? 'selected' : null}}>{{$p}}</option>
                @endforeach
            </select>

            @php
                $services = $Model('Term')::where('parent', 3)->get();
            @endphp
            <select name="term_parent" id="term_no_get"
                    class="xform-control contact-form-wrap-control">
                <option value="">Select Service Group</option>
                @foreach($services as $key => $value)
                    <option {{request()->term_parent ==  $value->id ? 'selected' : null}}
                        value="{{ $value->id ?? NULL }}">{{ $value->name ?? NULL }}</option>
                @endforeach
            </select>
            <select name="sub_term_id" id="level_no_get"
                    class="xform-control contact-form-wrap-control">
                    <option value="">Select a parent...</option>
                    @if(request()->term_parent && request()->sub_term_id)
                    @php $getSubTermServices =  $Model('Term')::where('parent', request()->term_parent)->get(); @endphp
                    @foreach($getSubTermServices as $value)
                     <option {{request()->sub_term_id ==  $value->id ? 'selected' : null}}
                         value="{{$value->id}}">{{$value->name }}</option>
                    @endforeach
                    @endif
            </select>

            <div class="form-group me-2">
                {{ Form::text('date_range', request()->get('date_range'), [ 'autocomplete' => 'off', 'class' => 'form-control', 'id'=> 'date_range',]) }}
            </div>

            <div class="form-group me-2">
                <input type="text" name="search_field" class="form-control" value="{{request()->search_field}}">
            </div>

            <div class="form-group">
                <button class="px-2 btn btn-secondary text-dark bg-white btn-sm p-0 h-22 border-1"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="content-wrapper">

        <div class="row">
            @php
                //dump(auth()->user()->id);
                $orders = $Model('BookingGeneralInformation')::with('order_items', 'order_payments')->orderBy('id', 'desc');
                //dump($o);
                //$orders =  $Model('BookingOrderItem')::orderBy('id', 'desc')->get()->groupBy('general_info_id');
                //dump($orders);

                if(request()->term_parent){
                    //$orders = $orders->where('')
                        $termParent = request()->term_parent;
                        $orders = $orders->whereHas('order_items', function ($query) use ($termParent){
                            $query->where('service_id', $termParent);
                        });
                }

                if(request()->sub_term_id){
                    //$orders = $orders->where('')
                        $subTerm = request()->sub_term_id;
                        $orders = $orders->whereHas('order_items', function ($query) use ($subTerm){
                            $query->where('sub_service_id', $subTerm);
                        });
                }

                if(request()->date_range){
                    $date_range = request()->get('date_range');
                    $dates = explode('-', $date_range);
                    $start_date = date('Y-m-d', strtotime(trim($dates[0])));
                    $end_date = date('Y-m-d', strtotime(trim($dates[1])));
                    $orders =   $orders->whereDate('created_at','>=', $start_date)
                                        ->whereDate('created_at','<=', $end_date);
                }

                if(request()->search_field){
                    $searchField = request()->search_field;
                    //$orders = $orders->whereHas('order_items', function ($query) use ($searchField){
                      //      $query->where('service_id', 'like', '%'.$searchField.'%');
                        //});
                    $orders = $orders->where('email_address', 'like', '%'.$searchField.'%')
                                    ->orWhere('full_name', 'like', '%'.$searchField.'%')
                                    ->orWhere('contact_no', 'like', '%'.$searchField.'%');
                }

                if(request()->order_status){
                     $orders = $orders->where('order_status', request()->order_status);
                }

                $orders = $orders->paginate(request()->show_as_paginate ?? 30);

                //dd($orders);
                $orders->appends(request()->query());
            @endphp

            <table class="table table-hover table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>Order Info</th>
                    <th>Booked Services</th>
                    <th>Payment Info </th>
                    <th>Total Payable Amount</th>
                    <th>Total Paid Amount</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>


                @foreach($orders as $key => $order)
                    @php
                        $payment =  $Model('BookingOrderPayment')::where('general_info_id', $order->id)->orderBy('id', 'desc')
                                ->where('account_type', 'Received')
                                ->first();
                        $bookingGeneralInfo = $Model('BookingGeneralInformation')::where('id', $order->id)->first();
                    @endphp
                    <tr>

                        <td>
                            <b>ID:</b> {{$order->id}} <br>
                            <b>Hash Code:</b> {{$order->hash_code}} <br>
                            <b>Name:</b> {{$order->full_name}} <br>
                            <b>Email:</b> {{$order->email_address}} <br>
                            <b>Phone:</b> {{$order->contact_no}} <br>
                            <b>Postcode:</b> {{$order->post_code}} <br>
                            <b>Date:</b> {{$order->created_at->format('Y-m-d H:i:s a')}} <br>
                        </td>

                        <td>
                            @php
                                $services = $Model('BookingOrderItem')::where('general_info_id', $order->id)->get()->groupBy('sub_service_id');
                            @endphp
                            @if(count($services)>0)
                                @foreach($services as $key => $s)
                                    {{$Model('Term')::getColumn($key, 'name')}} <br>
                                    <p>
                                        @if(auth()->user()->hasRoutePermission('oz_order_view_order'))
                                        <a target="_blank" href="{{route('frontend_user_order', $order->hash_code)}}?get_single_service={{$key}}" class="d-inline-block badge bg-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @endif
                                        <a href="" class="d-inline-block badge bg-success"><i class="fa fa-comment"></i></a>
                                    </p>
                                @endforeach
                            @else
                                {{$Model('Term')::getColumn($order->sub_service_id, 'name')}}
                                <p>
                                    @if(auth()->user()->hasRoutePermission('oz_order_view_order'))
                                    <a target="_blank" href="{{route('frontend_user_order', $order->hash_code)}}?get_single_service={{$key}}" class="d-inline-block badge bg-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif
                                </p>
                            @endif

                        </td>

                        <td>
                            Payment Status: {{$payment->payment_status ?? null}} <br>
                            Payment Media: {{$payment->payment_media ?? null}}
                        </td>

                        <td>
                            @php
                                $total =  $Model('BookingOrderPayment')::where('general_info_id', $order->id)
                                           ->where('account_type', 'Receivable')
                                           ->get()->sum('amount') ?? 0;
                                $discount = $Model('BookingOrderPayment')::where('general_info_id', $order->id)
                                                ->where('account_type', 'Discount')
                                                ->get()->sum('amount') ?? 0;
                                //dump($discount);
                                $alreadyPaid = $Model('BookingOrderPayment')::where('general_info_id', $order->id)
                                                ->where('account_type', 'Received')
                                                ->get()->sum('amount') ?? null;
                            @endphp
                            <small>
                                <b>Order Total:</b>  ${{$total}} <br>
                               <b> Discount:</b> ${{$discount}} <br>
                                <b>Grand Total:</b> ${{ round($total - $discount) }}
                            </small>

                        </td>
                        <td>
                            ${{round($alreadyPaid)}}
                        </td>
                        <td>
                            {{$order->order_status}}
                        </td>
                        <td>
                            @if(auth()->user()->hasRoutePermission('oz_order_view_order'))
                            <a target="_blank" href="{{route('frontend_user_order', $order->hash_code)}}">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endif
                            @if(auth()->user()->hasRoutePermission('oz_order_destroy'))
                                {!! $ButtonSet::delete('oz_order_destroy', $order->id) !!}
                            @endif

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table table-hover d-none" id="pages">
                {{-- <thead>
                    <th></th>
                    <th>Name</th>
                </thead> --}}
            </table>
        </div>
    </div>

@endsection


@section('breadcrumb-bottom')

    {{$orders->links()}}

@endsection


@section('cusjs')
    @include('components.datatable')

    <script type="text/javascript">
        /*
        jQuery(document).ready(function ($) {
            $.noConflict();

            let field = [
                {"data" : 'button'},
                {"title" : "Order Date", "data" : 'order_date'},
                {"title" : "Payment Status", "data" : "payment_status"},
                {"title" : "Payment Media", "data" : "payment_media"},
            ];
            loadDatatable("#pages", "{{ route('oz_order_api_get') }}", field);

        });
        */
    </script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>


    <script>
        jQuery(document).ready(function($){
            $('#term_no_get').on('change', function () {
                let term_id = $(this).val();

                let url = "{{ route( 'frontend_sub_terms_getter', '')  }}/" + term_id;

                $.get(url, function (data, status) {
                    $('#level_no_get').html(data.html);
                });
            });

            $('#date_range').daterangepicker({
                opens: 'right',
                autoUpdateInput: false,
                locale: {
                    format: 'DD/MM/YYYY',
                }
            }, function (start, end, label) {

                //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
            $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });
        })

    </script>
@endsection

