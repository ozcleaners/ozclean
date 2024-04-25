<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Mail\SendMail;
use App\Models\CalcMaterialSetting;
use App\Models\CalcServiceSetting;
use App\Models\Roleuser;
use App\Models\StripeCard;
use App\Models\Term;
use App\Models\User;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;
use App\Models\BookingGeneralInformation;
use App\Models\BookingOrderItem;
use Illuminate\Support\Facades\Hash;
use App\Models\BookingOrderPayment;
use PDF;
use Mail;

class BookingController extends Controller
{
    public function form()
    {
        return view('frontend.booking-form.general_info');
    }

    public function general_info_store(Request $request)
    {
        $attributes = [
            'full_name' => $request->full_name,
            'contact_no' => $request->contact_no ?? NULL,
            'email_address' => $request->email_address,
            'post_code' => $request->post_code,
            'service_id' => $request->term_parent,
            'sub_service_id' => $request->sub_term_id,
            'hash_code' => date('YmdHis'), //$request->hash_code
            'order_status' => 'Just-created'
        ];
        //dd($attributes);

        try {
            $booking_general_info = BookingGeneralInformation::create($attributes);
            return redirect()->route('frontend_service_details', $booking_general_info->hash_code);
        } catch (\Exception $e) {
            //dd($e->errorInfo[2]);
            $errormsg = $e->errorInfo[2];
        }
    }

    public function service_details(Request $request, $id)
    {
        //dump($id);
//        dd($request->all());
        //$datas = BookingGeneralInformation::find($id);
        $datas = BookingGeneralInformation::where('hash_code', $id)->first();
        return view('frontend.booking-form.quotation-info')->with([
            'general_infos' => $datas,
            'hash_code' => $id,
            'service_id' => $request->service_id,
            'sub_service_id' => $request->sub_service_id
        ]);
    }

    public function get_sub_terms($id)
    {
        $services = Term::where('parent', $id)->get();
        $getRequestHashCode = request()->get('hash_code');
        $catchedSubService = request()->get('set_sub_service_id');
//        dd($getRequestHashCode);
        $getAlreadySelectedService = BookingOrderItem::where('hash_code', $getRequestHashCode)->get()->groupBy('sub_service_id')->toArray();
//        dd($getAlreadySelectedService);


        $html = '';
        //$html = '<label>Select Service</label><span class="form-field-wrap align-items-center">';
        $html .= '<option value="" selected disabled>Select a Service</option>';
        foreach ($services as $key => $value) {

//            $html .= '<div class="form-check d-inline-block mr-4">';
//            $html .= '<label class="containerRadio form-check-label fw-400 mb-1" for="'.$value->id.'">';
//            $html .= '<input id="'.$value->id.'" class="form-check-input select-radio mr-1 term_no_get" name="sub_term_id" type="radio" value="'.$value->id.'">';
//            $html .= '<span class="checkmark"></span>';
//            $html .= '<img src="'.$this->Model('Media')::iconSize($value->term_menu_icon).'" class="mx-3" style="width: 45px;">';
//            $html .= $value->name ?? NULL;
//            $html .= '</label>';
//            $html .= '</div>';
            if(array_key_exists($value->id, $getAlreadySelectedService) || $catchedSubService == $value->id){

            }else {
                $html .= '<option data-calc_template="'.$value->calculator_template.'"  value="' . $value->id . '">';
                $html .= $value->name ?? NULL;
                $html .= '</option>';
                if($value->alternative_name){
                    $altn = explode(' | ', $value->alternative_name);
                    foreach ($altn as $item){
                        $html .= '<option data-calc_template="'.$value->calculator_template.'"  value="' . $value->id . '">';
                        $html .= $item ?? NULL;
                        $html .= '</option>';
                    }
                }
            }
        }
        //$html .= '</span>';
        return response()->json([
            'html' => $html,
            'status' => 1
        ]);
    }

    public function service_materials_get($id, $term_id)
    {
        // dd($id);
        if ($id && $term_id) {
            $materials = CalcMaterialSetting::where('service_id', $term_id)->where('section_id', $id)->get();
            $serviceInfo = CalcServiceSetting::where('service_id', $term_id)->where('id', $id)->first();
            $html = '<option>Select a Material';

            foreach ($materials as $value) {
                $html .= '<option value="' . $value->id . '">';
                $html .= $value->material_title ?? NULL;
                $html .= '</option>';
            }
            $status = 1;
        } else {
            $html = null;
            $status = 0;
            $serviceInfo = null;
        }
        return response()->json([
            'html' => $html,
            'status' => $status,
            'service_info' => $serviceInfo,
        ]);
    }


    public function get_booking_schedule(Request $request)
    {
//        dd($request->all());
        $date = date_create($request->get_date);
        $date = date_format($date, 'Y-m-d');
//        dd($date);
        $available_starting_times = $this->Model('ScheduleManager')::where('service_id', $request->sub_service_id)
            ->where('zone_id', $request->zone_id)
            ->where('date', $date)
            ->groupBy('from_hour', 'within_hour')
            ->get();
//        dd($available_starting_times);
        $getDay = $this->Model('ScheduleManager')::where('service_id', $request->sub_service_id)
                ->where('zone_id', $request->zone_id)
                ->where('date', $date)
                ->first()
                ->day ?? null;
        $getRate = $this->Model('CalcBasicSetting')::where('service_id', $request->sub_service_id)
                ->where('setting_type', '24')
                ->where('setting_title', $getDay)
                ->first() ?? null;
        $data = [
            'times' => $available_starting_times,
            'day' => $getDay,
            'rate' => $getRate->rate ?? 0,
            'equation_type' => $this->Model('AttributeValue')::getColumnById($getRate->equation_type ?? null)->slug ?? null,
        ];
//        dd($data);
        return response()->json($data);
    }


    public function bookingOrderStore(Request $request)
    {
//        dd($request->all());
        $bookingGeneralInfo = BookingGeneralInformation::where('id', $request->general_info_id)->first();
        $checkAuthUser = $this->Model('User')::where('email', $bookingGeneralInfo->email_address)->first();

        if ($checkAuthUser) {
            $userId = $checkAuthUser->id;
        } else {
            $createUser = [
                'name' => $bookingGeneralInfo->full_name,
                'email' => $bookingGeneralInfo->email_address,
                'phone' => $bookingGeneralInfo->contact_no,
                'postcode' => $bookingGeneralInfo->post_code,
                'password' => Hash::make($bookingGeneralInfo->contact_no),
            ];
            $userId = $this->Model('User')::create($createUser); //Create User
            $userId = $userId->id;
            //RoleId Set
            Roleuser::create(['user_id' => $userId, 'role_id' => 3]);
        }
        $ids = null;
        $items = null;
        if ($request->services) {
            foreach ($request->services as $index => $data) {
                $getSelectedService = $data ?? null;
                foreach ($data as $k => $v) {
                    $v = (object)$v;
                    $mkArry = [
                        'auth_user_id' => $userId,
                        'zone_id' => $request->zone_id,
                        'general_info_id' => $request->general_info_id,
                        'hash_code' => $request->hash_code,
                        'service_id' => $request->service_id,
                        'sub_service_id' => $request->sub_service_id,
                        'accounts_type' => $index,
                        'service_slug' => $v->slug ?? null,
                        'service_title' => $v->title ?? null,
                        'service_qty' => $v->qty ?? 1,
                        'service_base_price' => $v->base_price ?? 0,
                        'service_extra_default_price' => $v->extra_default ?? 0,
                        'service_equation_type' => $v->equation_type ?? null,
                        'service_minimum_price' => $v->minimum_price ?? 0,
                        'service_postcode_price' => $v->postcode_price ?? 0,
                        'service_amount' => $v->amount ?? 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                    $items [] = $mkArry;
                }
            }

            BookingOrderItem::where('general_info_id', $request->general_info_id)->where('sub_service_id', $request->sub_service_id)->delete();
            //dd($items);
            BookingOrderItem::insert($items);
        }

        //If customer want to quote in his/her Email
        if($request->get_email_quote){
            $subject = $this->Model('Term')::getColumn($request->service_id, 'name').' - '. $this->Model('Term')::getColumn($request->sub_service_id, 'name') ;
            $address = $bookingGeneralInfo->email_address;
            $emailData = [
                'template' => 'email.save-quote',
                'code' => $bookingGeneralInfo->hash_code,
                'message' => false,
                'attachment' => false,
            ];
            //MailHelper::send($emailData, $subject, $address, $cc_emails = false);
            Mail::to($address)->send(new OrderMail($emailData, $subject, $cc_emails = false));
            BookingGeneralInformation::where('id', $request->general_info_id)->update([
                'order_status' => 'Quotation'
            ]);
            $confirmMessage = 'Thanks for visiting Oz Cleaners to get a quote for your service. <br> Your quote has been emailed and you can come back anytime to confirm the booking.';
            return redirect()->route('frontend_thank_you')->with([
                'hash_code' => $bookingGeneralInfo->hash_code,
                'message' => $confirmMessage
            ]);
        }else {
            BookingGeneralInformation::where('id', $request->general_info_id)->update([
                'order_status' => 'Service-items-select'
            ]);
        }


        if ($request->add_another_service) {

            $hash_code = $request->hash_code;
            $service_id = $request->service_id; //$request->add_another_service['service_id'];
            $sub_service_id = $request->add_another_service['sub_service_id'];

            return redirect()->route('frontend_service_details', [$hash_code, 'service_id' => $service_id, 'sub_service_id' => $sub_service_id]);
        } else {
            return redirect()->route('frontend_service_details', [$request->hash_code, 'param-sd' => $request->hash_code]);
        }
    }


    public function checkout(Request $r)
    {
//        dd($r->all());


        $token = $_POST['stripeToken'];
        $payable_amount = $_POST['payable_amount'];
        $payable_amount = round($payable_amount * 100);

        $payment_attr = function ($accountType, $amount, $paymentMedia, $payStatus = null) use ($r) {

            return [
                'auth_user_id' => User::where('email', $r->email)->first()->id,
                'general_info_id' => BookingGeneralInformation::where('hash_code', $r->hash_code)->first()->id,
                'hash_code' => $r->hash_code,
                'account_type' => $accountType,
                'payment_media' => $paymentMedia,
                'amount' => (float)$amount,
                'media_token' => $r->stripeToken ?? null,
                'payment_status' => $payStatus,
                'payment_date' => date('Y-m-d H:i:s'),
            ];
        };
        //Receiveable amount insert
        BookingOrderPayment::create($payment_attr('Receivable', $r->total_amount, null, null));

        //overwrite pasword
        if (!empty($r->passowrd)) {
            $cpass = Hash::make($r->passowrd);
            User::where('email', $r->email)->update(['password' => $cpass]);
        }

        //update Shipping Address
        $addressInfo = [
            'unit_no' => $r->unit_no,
            'address' => $r->address,
            'suburb' => $r->suburb,
            'state' => $r->state,
            'post_code' => $r->post_code,
            'property_access' => $r->property_access,
            'access_notes' => $r->access_notes,
            'parking_instructions' => $r->parking_instructions,
        ];
        BookingGeneralInformation::where('hash_code', $r->hash_code)->update(
            [
                'address_information' => json_encode($addressInfo),
                'contact_no' => $r->phone,
            ]
        );

        //


//        \Stripe\Stripe::setApiKey("sk_test_RhMnpjeNrp1mjlhY4k7z4dYD00udaH0KSJ");
        \Stripe\Stripe::setApiKey($this->Query::frontendSettings('stripe_secret_key'));


        try {

            $customer = \Stripe\Customer::create([
                'source' => $token,
                'email' => $r->email,
            ]);

            $charge = \Stripe\Charge::create([
                'amount' => $payable_amount,
                'currency' => 'aud',
                'customer' => $customer->id,
            ]);


            StripeCard::create([
                'user_id' => User::where('email', $r->email)->first()->id,
                'order_master_id' => BookingGeneralInformation::where('hash_code', $r->hash_code)->first()->id,
                'stripe_user_id' => $customer->id,
            ]);

            $success = BookingOrderPayment::create($payment_attr('Received', $r->payable_amount, 'Stripe', 'Partial'));
            if ($success) {
                $success = true;
            } else {
                $success = false;
            }

        } catch (\Stripe\Stripe_CardError $e) {
            $error1 = $e->getMessage();
        } catch (\Stripe\Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            $error2 = $e->getMessage();
        } catch (\Stripe\Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            $error3 = $e->getMessage();
        } catch (\Stripe\Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            $error4 = $e->getMessage();
        } catch (\Stripe\Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $error5 = $e->getMessage();
        } catch (\Stripe\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $error6 = $e->getMessage();
        }

        if ($success != 1) {
            $_SESSION['error1'] = $error1;
            $_SESSION['error2'] = $error2;
            $_SESSION['error3'] = $error3;
            $_SESSION['error4'] = $error4;
            $_SESSION['error5'] = $error5;
            $_SESSION['error6'] = $error6;
            return redirect()->route('frontend_payment_failed')->with(['hash_code' => $r->hash_code]);
        } else {
            $data = 'Your order has been received. You can track your order. Please login to your account using following email address - ';
            $data .= $r->email;

            $data .= 'Please grab your password from below- ';
            $data .= '<br/>';
            //overwrite pasword
            if (!empty($r->passowrd)) {
                $cpass = $r->passowrd;
            } else {
                $cpass = User::where('email', $r->email)->first()->phone;
            }
            $data .= $cpass;

            $subject = 'Track your order on OzCleaners.com.au';
            $address = $r->email;
            $emailData = [
                'template' => 'email.order_confirmed',
                'code' => $r->hash_code,
                'message' => $data
            ];
            //MailHelper::send($emailData, $subject, $address, $cc_emails = false);
            Mail::to($address)->send(new OrderMail($emailData, $subject, $cc_emails = false));
            BookingGeneralInformation::where('hash_code', $r->hash_code)->update([
                'order_status' => 'Recieved'
            ]);
            $confirmMessage = 'Thanks for choosing Oz Cleaners for your service. <br> We will do our best to make you happy and will not let you down.';
            return redirect()->route('frontend_booking_confirmed')->with([
                    'hash_code' => $r->hash_code,
                    'message' => $confirmMessage
                ]);
        }
    }

    public function thank_you(Request $r)
    {
        if (session()->get('hash_code')) {
            return view('frontend.booking-form.thank_you');
        }
    }

    public function userDashboard()
    {
        if (auth()->check()) {
            return view('frontend.user.dashboard');
        } else {
            return redirect()->route('login');
        }
    }


    public function userOrder($hash_code)
    {
        if (auth()->check()) {
            $booking_order_item = BookingOrderItem::where('hash_code', $hash_code);
            if (!empty(request()->get('get_single_service')) && request()->get('get_single_service')) {
                $booking_order_item = $booking_order_item->where('sub_service_id', request()->get('get_single_service'));
            }
            $booking_order_item = $booking_order_item->get()->groupBy('sub_service_id');
            $booking_general_info = BookingGeneralInformation::where('hash_code', $hash_code)->first();
            return view('frontend.user.view_order', compact('booking_order_item', 'booking_general_info'));
        } else {
            return redirect()->route('login');
        }
    }

    public function downloadPdf($hash_code)
    {
        $booking_order_item = BookingOrderItem::where('hash_code', $hash_code);
        if (!empty(request()->get('get_single_service')) && request()->get('get_single_service')) {
            $booking_order_item = $booking_order_item->where('sub_service_id', request()->get('get_single_service'));
        }
        $booking_order_item = $booking_order_item->get()->groupBy('sub_service_id');

        $booking_general_info = BookingGeneralInformation::where('hash_code', $hash_code)->first();
        $pdf = PDF::loadView('frontend.user.invoice-download-format', compact('booking_order_item', 'booking_general_info'));
//        $pdf = PDF::loadView('email.save-quote', compact('booking_order_item', 'booking_general_info'));
        $pdf->render();
        return $pdf->download('invoice-' . $hash_code . '.pdf');

        //return view('frontend.user.view_order', compact('booking_order_item', 'booking_general_info'));
    }


    public function popupCalculatorSubmit(Request $r){
//        dd($r->all());
        $hash_code = date('YmdHis');
        $addressInfo = [
            'unit_no' => $r->unit_no,
            'address' => $r->address,
            'state' => $r->state,
            'post_code' => $r->post_code,
            'suburb' => $r->suburb,
            'subject' => $r->subject,
            'message' => $r->massage,
        ];
        $attributes = [
            'full_name' => $r->full_name,
            'contact_no' => $r->contact_no ?? NULL,
            'email_address' => $r->email_address,
            'post_code' => $r->post_code,
            'service_id' => $r->service_id,
            'sub_service_id' => $r->sub_service_id,
            'hash_code' => $hash_code, //$r->hash_code,
            'address_information' => json_encode($addressInfo)
        ];
//        dd($attributes);
        $booking_general_info = BookingGeneralInformation::create($attributes);
        return redirect()->route('frontend_thank_you')->with(['hash_code' => $hash_code, 'message' => 'Thanks for considering Oz Cleaners to provide you a quote for your required service.
<br> One of our friendly team members will get back to you soon.
']);
    }


    public function quote_request(){
        return view('frontend.booking-form.quote_request');
    }


}
