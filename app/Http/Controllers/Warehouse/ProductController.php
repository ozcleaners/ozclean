<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Warehouse\SingleWarehouseController;
use Illuminate\Http\Request;

class ProductController extends SingleWarehouseController
{
    public function index(){
        return view('admin.pages.warehouse.single.product.index');
    }
}
