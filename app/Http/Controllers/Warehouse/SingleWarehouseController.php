<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse;
use App\Models\User;

class SingleWarehouseController extends Controller
{
    protected $warehouse;
    protected $wh_code;


    public function __construct(Request $request, Warehouse $warehouse, User $user){

        $check = $warehouse::where('code', $request->wh_code)->first();

        $this->wh_code = $check->code ?? null;
        $this->warehouse = $warehouse;

        $request->attributes->add(['warehouse_name' => $check->name ?? null]);
        $request->attributes->add(['warehouse_code' => $check->code ?? null]);
        $request->attributes->add(['warehouse_id' => $check->id ?? null]);
        //$request->attributes->add(['hasPermission' => $user->checkUserWarehouseAccess()]);

        //Check User Access
        $this->middleware('warehouse');

    }
    
    /**
     * Dashboard
     */
    public function index(){
        // /dd(auth()->user()->checkUserWarehouseAccess());
        return view('admin.pages.warehouse.single.dashboard');
    }
}
