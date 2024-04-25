<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Warehouse;
use App\Models\Roleuser;

class WarehouseController extends Controller
{
    private $model;
    private $roleuser;
    public function __construct(Warehouse $model, Roleuser $roleuser)
    {
        $this->model = $model;
        $this->roleuser = $roleuser;
    }

    /**
     * @index
     */
    public function index(){
        //$wh = $this->model::get();
        $wh = auth()->user()->getUserWarehouse();
        return view('admin.pages.warehouse.index', compact('wh'));
    }

    /**
     * @Create
     */
    public function create(){
        return view ('admin.pages.warehouse.form');
    }

    /**
     * Data insert to DB
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
            ]
        );
        // process the login
        if ($validator->fails()) {
            return redirect('warehouse.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $hash =  bin2hex(random_bytes(2));
            $attributes = [
                'name' => $request->name,
                'code' => strtolower(str_replace(' ', '_', $request->name)).'_'.$hash,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
            ];
            //dd($attributes);
            $warehouse = $this->model::create($attributes);

            //Insert roleuser table 
            $assignAttr = [];
            if($request->assign_user != null){
                foreach($request->assign_user as $key => $assignUser){
                    $assignAttr []= $attributes = [
                        'user_id' => $assignUser['user_id'],
                        'role_id' => $assignUser['role_id'],
                        'warehouse_id' => $warehouse->id,
                    ];
                }//End Foreach
                //dd($assignAttr);
                $whr = $this->roleuser::insert($assignAttr);
            }//End if

            try {
                return redirect()->route('warehouse_index')->with(['status' => 1, 'message' => 'Successfully created user']);
            } catch (\Exception $e) {
                //dd($e->errorInfo[2]);
                $errormsg = $e->errorInfo[2];
            }
        }
    }

    /**
     * Edit a Single Warehouse
     * by Id
     */
    public function edit($id)
    {   
        $wh = $this->model::find($id);
        $assignedUser = $this->roleuser::where('warehouse_id', $id)->get();
        return view('admin.pages.warehouse.form', compact('wh', 'assignedUser'));
    }

    /**
     * Update Data of DB
     * 
     */
    public function update(Request $request)
    {
        //Catch Warehouse Information 
        $attributes = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
        ];
        $wh = $this->model::where('id', $request->id)->update($attributes); //End Warehouse Inormation Update

        //Assign User to Warehouse
        $existing = $this->roleuser::where('warehouse_id', $request->id)->delete() ?? Null;//Delete Existing Data
        
        //Store to RoleUser
        $assignAttr = [];
        if($request->assign_user != null){
            foreach($request->assign_user as $key => $assignUser){
                $assignAttr []= $attributes = [
                    'user_id' => $assignUser['user_id'],
                    'role_id' => $assignUser['role_id'],
                    'warehouse_id' => $request->id,
                ];
            }//End Foreach
            //dd($assignAttr);
            $whr = $this->roleuser::insert($assignAttr);
        }//End if
        
        try {
            return redirect()->back()->with(['status' => 1, 'message' => 'Successfully updated']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 0, 'message' => 'Error']);
        }
    }

    /**
     * Delete Data from DB
     */
    public function destroy($id)
    {
        $wh = $this->model::find($id);
        $wh->delete(); 
        return redirect()->back()->with(['status' => 1, 'message' => 'Successfully deleted']);
    }


}
