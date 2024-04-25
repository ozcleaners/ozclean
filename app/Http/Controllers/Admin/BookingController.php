<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingOrderItem;
use App\Models\BookingOrderPayment;
use Illuminate\Http\Request;
use DB;
use App\Models\BookingGeneralInformation;
class BookingController extends Controller
{
    public function adminOrders(){
        return view('admin.pages.oz.order.index');
    }

    /**
     * Delete Order
     * @param $id = General Info ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $items = BookingOrderItem::where('general_info_id', $id)->delete() ?? null;
        $payments = BookingOrderPayment::where('general_info_id', $id)->delete() ?? null;
        $data = BookingGeneralInformation::find($id);
        $data->delete();

        return redirect()->back()->with([
            'status' => 1,
            'message' => 'Deleted Successfully',
        ]);
    }


    public function add_service_item_by_admin(Request $request){
//        dd($request->all());

        $items = [
            'hash_code' =>$request->hash_code,
            'general_info_id' =>$request->general_info_id,
            'auth_user_id' => $request->auth_user_id,
            'zone_id' =>$request->zone_id,
            'service_id' =>$request->service_id,
            'sub_service_id' =>$request->sub_service_id,
            'accounts_type' =>$request->service_option,
            'service_title' =>$request->service_desc,
            'service_qty' => 1,
            'service_extra_default_price' => 0,
            'service_base_price' => $request->service_amount,
            'service_equation_type' => 'fixed',
            'service_amount' => $request->service_amount,
        ];
//        dd($items);
        BookingOrderItem::create($items);

        $payment = [
            'auth_user_id' => $request->auth_user_id,
            'general_info_id' =>$request->general_info_id,
            'hash_code' =>$request->hash_code,
            'account_type' => $request->service_option == 'upsell' ? 'Receivable' : 'Discount',
            'payment_media' => null,
            'amount' => $request->service_amount,
            'payment_date' => date('Y-m-d H:i:s'),
        ];
        BookingOrderPayment::create($payment);
        return redirect()->back();
    }

    /**
     * Order Api for Datatable
     * @param Request $request
     * @return mixed
     */
    public function getApiOrder(Request $request){
//        DB::table('booking_order_items as boi'):
//        $orders =  $this->Model('BookingOrderItem')::query()
//            ->leftjoin('booking_general_information', 'booking_general_information.id', 'booking_order_items.general_info_id')
//            ->select('booking_general_information.*', 'booking_order_items.*')
//            ->groupBy('booking_order_items.general_info_id')
//            ->get();
        $orders = $this->Model('BookingGeneralInformation')::query()
            ->leftjoin('booking_order_items', 'booking_order_items.general_info_id', 'booking_general_information.id')
            ->select('booking_order_items.*', 'booking_general_information.*');

//    dd($orders);
        $field = [
            'button' => '',
            'order_date' => '$data->created_at->format("Y-m-d")',
            'payment_status' => '',
            //'seo_url' => '"/".$data->seo_url',
            'payment_media' => '',
            // 'description' => '$data->description'
        ];

        return $this->Datatable::generate($request, $orders, $field);
    }
}
