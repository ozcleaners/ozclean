<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Invoice styling -->
    <style type="text/css">
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
            font-size: 14px;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px 0px;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 0px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 0px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .tableStyle {
            cellspacing:0;
            color:#000;
            font-family:'Helvetica Neue',Arial,sans-serif;
            font-size:13px;
            line-height:22px;
            table-layout:auto;
            width:100%;
        }
        .trStyle  {
            border-bottom:1px solid #ecedee;
            text-align:left;
        }
        .tdStyle {
            padding:10px 5px;
            word-break:break-word;
            font-size: 14px;
        }
        .tdDivStyle {
            line-height:24px;
            text-align:left;
            color: #000;
        }
        .email-footer {
            font-size:0px;
            padding:10px 0px;
            word-break:break-word;
        }

    </style>
</head>

<body>

<div class="invoice-box">
    <table>
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ $Media::fullSize(get_global_setting('logo')) }}" alt="">
                        </td>

                        <td>
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
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
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

                        <td>
                            <div>
                                <strong>Invoice No. : </strong>
                                {{$booking_general_info->hash_code}}
                            </div>

                            <div>
                                <strong>Invoice Date : </strong>
                                {{$booking_general_info->created_at->format('Y-m-d')}}
                            </div>
                            <?php /*
{{--                            <div class="">--}}
{{--                                <strong>Total Amount (AUD) : </strong>--}}
{{--                                ${{$Model('BookingOrderPayment')::getTotalAmount($booking_general_info->id)}}--}}
{{--                            </div>--}}
*/ ?>
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
                </table>
            </td>
        </tr>

    </table>

    <table>
        @include('email.view-order-items', ['hash_code' => $booking_general_info->hash_code, 'add_service_in_order' => false])
        @include('email.layouts.email-footer')
    </table>
</div>
</body>
</html>
