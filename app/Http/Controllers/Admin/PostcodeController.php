<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postcode;
use App\Models\PostcodeRate;

class PostcodeController extends Controller
{
    protected $model;

    public function __construct(Postcode $model){
        $this->model = $model;
    }

    public function index($id=null){
        if($id){
            $postcode = $this->model::find($id);
        }
        $postcode = $postcode ?? null;
        return view('admin.pages.oz.postcode.index', compact('postcode'));
    }
    public function storeUpdate(Request $request){
        $attr = [
            'zone_id' => $request->zone_id,
            'postcode' => $request->post_code,
        ];

        if($request->id){
            $this->model::where('id', $request->id)->update($attr);
        }else {
            $this->model::create($attr);
        }
        return redirect()->route('oz_postcode_index')->with(['status' => 1, 'message' => 'Successfully created']);
    }

    public function destroy($id){
        $data = $this->model::find($id);
        $data->delete();
        return redirect()->route('oz_postcode_index')->with(['status' => 0, 'message' => 'Successfully deleted']);
    }

    public function checkPostService($postcode, $service_id){
        $data = PostcodeRate::where('postcode', $postcode)->where('service_id', $service_id)->first();
        return response()->json([
            'status' => $data ? 1 : 0,
            'data' => $data,
        ]);
    }
}
