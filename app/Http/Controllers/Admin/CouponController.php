<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CouponController extends Controller
{
    protected $model;

    public function __construct(Coupon $model){
        $this->model = $model;
    }

    public function index(){
        $coupons = [];
        return view('admin.pages.oz.coupon.index', compact('coupons'));
    }


    /**
     * @param Request $request
     * @return $this
     * @internal param Request $request
     */
    public function store(Request $request)
    {
        // dd($request);
        // read more on validation at
        $validator = Validator::make($request->all(),
            [
                'coupon_code' => 'required|unique:coupons',
                'start_date' => 'required',
                'coupon_type' => 'required',
                'coupon_type' => 'required',
                'allow_type' => 'required',
                'limit_type' => 'required'

            ]
        );

        // process the login
        if ($validator->fails()) {
            return redirect('coupons')
                ->withErrors($validator)
                ->withInput();
        } else {

            //dd($request);
            $converted = strtotime($request->get('start_date'));
            $start_date = date('Y-d-m', $converted);

            if($request->get('end_date')){
                $converted1 = strtotime($request->get('end_date'));
                $end_date = date('Y-m-d', $converted1);
            }else{
                $end_date = null;
            }



            if($request->get('allow_type') != 'All'){
                $services = array_to_strying(',', $request->get('coupon_service'));
            }else{
                $services = null;
            }


            // store
            $attributes = [
                'user_id' => auth()->user()->id,
                'coupon_code' => $request->get('coupon_code'),
                'coupon_amount' => $request->get('coupon_amount'),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'coupon_type' => $request->get('coupon_type'),
                'how_many_uses' => $request->get('how_many_uses'),
                'person_limit_user' => $request->get('person_limit_user'),
                'notes' => $request->get('notes'),
                'coupon_min' => $request->get('coupon_min'),
                'up_to' => $request->get('up_to'),
                'allow_type' => $request->get('allow_type'),
                'limit_type' => $request->get('limit_type'),
                'coupon_service' => $services,
                'is_active' => $request->get('is_active')
            ];

            // dd($attributes);
            $done = $this->model->create($attributes);
            //dd($done);
            return redirect()->back()->with(['status' => 1, 'message', 'Successfully save changed']);
            try {
                $done = $this->model->create($attributes);
                //dd($done);
                return redirect()->back()->with(['status' => 1, 'message', 'Successfully save changed']);
            } catch (\Illuminate\Database\QueryException $ex) {
                //dd($ex);
                return redirect()->back()->withErrors($ex->getMessage());
            }
        }

    }

}
