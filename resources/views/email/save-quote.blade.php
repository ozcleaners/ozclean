<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>

    </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass * {
            line-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-family:'Helvetica Neue',Arial,sans-serif;
        }

        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
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
            padding:10px 25px;
            word-break:break-word;
        }
        .tdDivStyle {
            line-height:16px;
            text-align:left;
            color: #000;
        }
        .email-footer {
            font-size:0px;
            padding:10px 25px;
            word-break:break-word;
        }
    </style>
    <!--[if !mso]><!-->
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {
                width: 320px;
            }
            @viewport {
                width: 320px;
            }
        }
    </style>
    <!--<![endif]-->
    <!--[if mso]>
    <xml>
    <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <!--[if lte mso 11]>
    <style type="text/css">
    .outlook-group-fix { width:100% !important; }
    </style>
    <![endif]-->


    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }
    </style>


    <style type="text/css">
    </style>

</head>

<body style="background-color:#f9f9f9;">




<div style="background-color:#f9f9f9;">
@php
    $bookingMaster = $Model('BookingGeneralInformation')::where('hash_code', $messages['code'] ?? '20220922005842')->first();
    //dd($bookingMaster);
@endphp

    <?php /*
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                        <tbody>
                        <tr>
                            <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">

                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">

                                <tr>

                                </tr>

                                </table>

                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </td>
        </tr>
    </table>
*/ ?>
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px; border-top:#333957 solid 5px" width="600">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">

                <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">

                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                    <tbody>
                        <tr>
                            <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:0px 0;text-align:center;vertical-align:top;">

                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">

                                <tr>

                                    <td style="vertical-align:bottom;width:600px;">


                                        <div class="mj-column-per-100 outlook-group-fix"
                                             style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">

                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">

                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width:64px;">
                                                                    <img height="auto" src="{{ $Media::fullSize(get_global_setting('logo')) }}" style="border:0;display:block;outline:none;text-decoration:none;width: auto;"  />

                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                        <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:24px;font-weight:bold;line-height:22px;text-align:center;color:#525252;">
                                                            Thank you for your order
                                                        </div>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                        <div style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:14px;line-height:22px;text-align:left;color:#525252;">
                                                            <p>Hi {{$bookingMaster->full_name}},</p>

                                                            <p>
                                                                Thank you for very much for using our online quote system at Oz Cleaners.
                                                                You didn’t confirm the booking; please tell us how can we help, if there is any issue? You can complete your booking anytime from the bellow link:
                                                            </p>
                                                                <p>
                                                                    <b>QUOTE LINK:</b>
                                                                    @php
                                                                        $quoteLink = route('frontend_service_details', $bookingMaster->hash_code);
                                                                    @endphp
                                                                    <a href="{{$quoteLink}}">{{$quoteLink}}</a>
                                                                </p>

                                                               <p>
                                                                   We, at Oz Cleaners, consider our customer’s happy face as profit and their references are the business.
                                                               </p>
                                                            <p>
                                                                <b>Your service details were:</b>
                                                            </p>
                                                        </div>

                                                    </td>
                                                </tr>

                                                @php
                                                    //$hash_code = $bookingMaster->hash_code;
                                                @endphp
                                                @include('email.view-order-items', ['hash_code' => $bookingMaster->hash_code])
                                                @include('email.layouts.email-footer')

                                            </table>

                                        </div>


                                    </td>

                                </tr>

                                </table>

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            </td>
        </tr>
    </table>

    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">

                <div style="Margin:0px auto;max-width:600px;">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                        <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="vertical-align:bottom;width:600px;">
                                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">

                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                                    <tbody>
                                                    <tr>
                                                        <td style="vertical-align:bottom;padding:0;">

                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">

                                                                <tr>

                                                                </tr>

                                                                <tr>

                                                                </tr>

                                                            </table>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </td>
        </tr>
    </table>

</div>

</body>

</html>
