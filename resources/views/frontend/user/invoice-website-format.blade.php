<link rel="stylesheet" type="text/css" href="{{$publicDir}}/xfrontend/css/bootstrap-4.css?{{rand(0,999)}}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<table class="table invoice_table" xstyle="border: 1px solid #ddd">

    <tr>
        <td colspan="2">
            <img src="{{ $Media::fullSize(get_global_setting('logo')) }}" alt="">
        </td>
        <td colspan="2" class="text-right">
            <h1 class="my-2">invoice</h1>
            <p style="margin: 0; padding: 0; font-size: 14px;">
                <strong> {{ $Query::globalSettings('name').' - '. $Query::globalSettings('slogan')}}</strong>
                <br>
                {!! $Query::globalSettings('address') !!}
                <br>
                Contact: {{ $Query::globalSettings('phone') }} <br>
                Email: {{ $Query::globalSettings('email') }}
            </p>
        </td>
    </tr>


    <tr>
        <td colspan="2">
            <strong>Bill To</strong>
            <p>
                <strong>{{$booking_general_info->full_name}}</strong><br>
                @php
                    $address = json_decode($booking_general_info->address_information, true);
                @endphp
                @if($address)
                {!! $address['address'] !!}<br>
                {!! $address['suburb'] !!}, {!! $address['state'] !!}, {!! $address['post_code'] !!} <br>
                @endif

                <b>Email:</b> {{$booking_general_info->email_address}}<br>
                <b>Contact:</b> {{$booking_general_info->contact_no}}
            </p>
        </td>

        <td colspan="2" class="text-right">
            <div>
                <strong>Invoice No. : </strong>
                {{$booking_general_info->hash_code}}
            </div>

            <div>
                <strong>Invoice Date : </strong>
                {{$booking_general_info->created_at->format('Y-m-d')}}
            </div>
{{--            <div class="">--}}
{{--                <strong>Total Amount (AUD) : </strong>--}}
{{--                ${{$Model('BookingOrderPayment')::getTotalAmount($booking_general_info->id)}}--}}
{{--            </div>--}}

            <div class="">
                <strong>Diposited: </strong>
                ${{round($Model('BookingOrderPayment')::getPaidAmount($booking_general_info->id))}}
            </div>

            @if(request()->get('get_single_service'))
            @else
            <div class="">
                <strong>Amount Due: </strong>
                ${{round($Model('BookingOrderPayment')::getDueAmount($booking_general_info->id))}}
            </div>
            @endif

        </td>
    </tr>
    @if(!empty($address['subject']))
        <tr>
            <td>
                <p>
                    <b>Subject</b> : {!! $address['subject'] !!}
                </p>

                <p>
                    <b>Message</b> : {!! $address['message'] !!}
                </p>
            </td>
        </tr>
    @endif



    <?php /*
        <tr>
        <td colspan="4">

            <table class="table table-bordered p-0 small-table border-0 mb-0">
                <tr class="text-center bg-info text-white">
                    <td class="text-left">Description</td>
                    <td width="10%">Qty</td>
                    <td width="10%">Price</td>
                    <td width="10%">Total Price</td>
                </tr>

                @php
                    $sub_total = [];

                @endphp
                @if(count($booking_order_item) > 0)
                    @foreach($booking_order_item as $key => $orders)
                        <?php
//                        /dump($key);

                        $services = $orders->groupBy('accounts_type');
                        $lservice =  [
                            [
                                'type' => 'main',
                                'name' => 'Property Details',
                                'loop' => $services['main'] ?? [],
                                'item' => true,
                                'qty_price_show' => true,
                            ],
                            [
                                'type' => 'basic',
                                'name' => '',
                                'loop' => $services['basic'] ?? [],
                                'qty_price_show' => false,
                                'item' => true,
                            ],
                            [
                                'type' => 'extra',
                                'name' => 'Extra Service',
                                'loop' => $services['extra'] ?? [],
                                'qty_price_show' => true,
                                'item' => true,
                            ],
                            [
                                'type' => 'other',
                                'name' => '',
                                'loop' => $services['other'] ?? [],
                                'qty_price_show' => false,
                                'item' => true,
                            ],
                            [
                                'name' => 'Upsell Service',
                                'loop' => $services['upsell'] ?? [],
                            ],
                            [
                                'name' => 'DownSell Service',
                                'loop' => $services['downsell'] ?? [],
                            ],
                        ];
                        ?>
                        <tr>
                            <td colspan="4" style="padding: 10px 0px !important;">
                                <strong>{{$Model('Term')::getColumn($key, 'name')}}</strong>
                                @if(auth()->user()->checkUserRoleTypeGlobal())
                                    <a href="javascript:void()" type="button"
                                       data-sub_service_id="{{$key}}"
                                       data-service_id="{{$Model('Term')::getColumn($key, 'parent')}}"
                                       class="calc-open-modal noprint">
                                        Add service
                                    </a>
                                @endif
                            </td>
                        </tr>


                        @foreach($lservice as $ls)
                            @if($ls['loop'])
                                <tr>
                                    <td colspan="4">
                                        <small><span class="text-muted">{{$ls['name']}}</span></small>
                                    </td>
                                </tr>
                                @foreach($ls['loop'] as $extra)


                                    @if($ls['type'] == 'extra' || 'main')
                                        <tr class="text-center">
                                            <td class="text-left"><?php echo $extra->service_title;?></td>
                                                @php
                                                    $priceShow = $ls['qty_price_show'] == true ? '' : 'd-none'
                                                @endphp
                                                <td class="{{$priceShow}}"><?php echo $extra->service_qty;?></td>
                                                <td class="{{$priceShow}}">
                                                    <?php
                                                    $ap = ($extra->service_extra_default_price / $extra->service_qty) + $extra->service_base_price;
                                                    $gp = $ap; //($ap/11)*10;
                                                    echo '$'.round($gp, 1);
                                                    ?>
                                                </td>
                                                <td class="text-right {{$priceShow}}">
            {{--                                        ${{$sub_total []= round($gp*$extra->service_qty, 2)}}--}}
                                                    ${{$sub_total []= round($extra->service_amount, 2)}}
                                                </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


                    @endforeach


                @else
                    <tr>
                        <td>
                            {{$Model('Term')::getColumn($booking_general_info->sub_service_id, 'name')}}
                        </td>
                    </tr>
                @endif
                <tr class="text-right" style="border-top: 1px solid #ddd; margin-top: 10px;">
                    <td colspan="3" class="font-weight-bold text-right ">Sub Total</td>
                    <td colspan="1">
                        ${{$sub_total = round(array_sum($sub_total), 2)}}
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="3"  class="font-weight-bold text-right">Discount</td>
                    <td colspan="1">
                        -${!! $discount = $Model('BookingOrderPayment')::where('general_info_id', $booking_general_info->id)
                                    ->where('hash_code', $booking_general_info->hash_code)
                                    ->where('account_type', 'Discount')->sum('amount') ?? 0.00 !!}

                    </td>
                </tr>
                @php
                    $upsell =$Model('BookingOrderPayment')::where('general_info_id', $booking_general_info->id)
                            ->where('hash_code', $booking_general_info->hash_code)
                            ->where('account_type', 'Receivable')->sum('amount') ?? 0.00;

                        $sub_total =  $sub_total-$discount;
                @endphp
                <tr class="text-right d-none">
                    <td colspan="3" class="text-right">GST 10%</td>
                    <td colspan="1">
{{--                        s{{   $upsell}}--}}
{{--                        ${{$gst = round(($sub_total*10)/100, 2) }}--}}
                        ${{$gst = round(0) }}
                    </td>
                </tr>

                <tr class="text-right">
                    <td colspan="3"  class="font-weight-bold text-right">Total</td>
                    <td colspan="1">
                        ${!!   round($sub_total+ $gst, 2) !!}
                    </td>
                </tr>

                @if(request()->get('get_single_service'))
                @else
                <tr class="text-right">
                    <td colspan="3" class="font-weight-bold text-right">Amount Due</td>
                    <td colspan="1">
                        {{$Model('BookingOrderPayment')::getDueAmount($booking_general_info->id)}}
                    </td>
                </tr>
                @endif

            </table>
        </td>
    </tr>
    */ ?>
</table>

<table>
    @include('email.view-order-items', ['hash_code' => $booking_general_info->hash_code, 'add_service_in_order' => true, 'get_single_service_id' => request()->get('get_single_service')])
    @include('email.layouts.email-footer')
</table>



<style>
    .small-table {
        width: 100%;
        font-size: 15px;
        border-collapse: collapse;
    }

    .small-table td, .small-table th {
        border: 1px solid #ddd;
        padding: 4px !important;
    }

    .table > tbody > tr > td {
        vertical-align: middle !important;
    }

    .invoice_table {

    }

    table.invoice_table tr td {
        border: 0 !important;
    }

    table.invoice_table table tr td {
        border: 0px solid #ddd !important;
    }

    table {
        width: 100%;
    }

    .tableStyle {
        cellspacing:0;
        color:#000;
        font-family:'Helvetica Neue',Arial,sans-serif;
        font-size:13px;
        line-height:22px;table-layout:auto;width:100%;
    }
    .trStyle  {
        border-bottom:1px solid #ecedee;
        text-align:left;
    }
    .tdStyle {
        padding:10px 5px;
        word-break:break-word;
        font-size: 16px;
    }
    .tdDivStyle {
        line-height:16px;
        text-align:left;
        color: #000;
    }
    @media print {
        .noprint { display: none; }
    }
</style>

<div class="calc-modal modal fade calculator_form toltip_content noprint" data-backdrop="static"
     data-keyboard="false" id="calcModal" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Add a Service Item
            </div>
            <div class="modal-body">
                <form action="{{route('oz_order_add_service_item_by_admin')}}" method="post">
                @csrf
                <div class="modal-details">
                    <input type="hidden" class="addi_sub_service_id" name="sub_service_id" value="">
                    <input type="hidden" class="addi_service_id" name="service_id" value="">
                    <input type="hidden" class="general_info_id" name="general_info_id" value="{{$booking_general_info->id}}">
                    <input type="hidden" class="hash_code" name="hash_code" value="{{$booking_general_info->hash_code}}">
                    <input type="hidden" class="zone_id" name="zone_id"
                           value="{{ $Model('Postcode')::where('postcode', $booking_general_info->post_code)->first()->zone_id ?? null }}">
                    <input type="hidden" class="auth_user_id" name="auth_user_id"
                           value="{{ $Model('User')::where('email', $booking_general_info->email_address)->first()->id ?? null }}">
                    <div>
                        <div class="form-group">
                           <div class="d-inline-block">
                               <input type="radio" name="service_option" id="upsell" value="upsell" required>
                               <label for="upsell">Upsell</label>
                           </div>
                          <div class="d-inline-block">
                              <input type="radio" name="service_option" id="downsell" value="downsell" required>
                              <label for="downsell">Downsell</label>
                          </div>
                            <div class="d-inline-block">
                                <input type="radio" name="service_option" id="discount" value="discount" required>
                                <label for="discount">Discount</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service_desc">Service Description</label>
                            <textarea class="form-control" name="service_desc" id="service_desc"  cols="30" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Service Amount</label>
                            $ <input type="number" step="0.2" name="service_amount" class="form-control" value="" required>
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn get_quote_btn_2 modal-close">
                        Submit
                    </button>
                    <button type="button" class="btn get_quote_btn modal-close" data-dismiss="modal">
                        Close
                    </button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>

@section('cusjs')
    @parent
    <script>
        jQuery(document).ready(function ($) {
            $('.calc-open-modal').click(function(e){
                e.preventDefault()
                let subServiceId = $(this).data('sub_service_id');
                let serviceId = $(this).data('service_id');
                $('.calc-modal .addi_sub_service_id').val(subServiceId)
                $('.calc-modal .addi_service_id').val(serviceId)
                $('.calc-modal').modal('show');
            })
        })
    </script>
@endsection

