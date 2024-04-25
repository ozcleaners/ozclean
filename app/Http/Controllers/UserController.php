<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Roleuser;
use DB;

class UserController extends Controller
{
    private $model;
    private $roleuser;


    public function __construct(User $model, Roleuser $roleuser)
    {
        $this->model = $model;
        $this->roleuser = $roleuser;
    }

    /**index */
    public function index(){
        $users = $this->model::with('roles')->get();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create(){
        return view('admin.pages.users.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]
        );
        // process the login
        if ($validator->fails()) {
            return redirect('user.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $attributes = [
                'name' => $request->name,
                'email' => $request->email,
                'employee_no' => $request->employee_no,
                'phone' => $request->phone,
                'address' => $request->address,
                'postcode' => $request->postcode,
                'district' => $request->district,
                'gender' => $request->gender,
                'password' => bcrypt('mtsbd123'),
            ];
            //dd($attributes);
            $user = $this->model::create($attributes);

            //Insert roleuser table

            $roleAttr = [
                'role_id' => $request->role_id,
                'user_id' => $user->id,
            ];

            $roleuser = $this->roleuser::create($roleAttr);

            try {
                return redirect()->route('user_index')->with(['status' => 1, 'message' => 'Successfully created user']);
            } catch (\Exception $e) {
                //dd($e->errorInfo[2]);
                $errormsg = $e->errorInfo[2];
            }
        }
    }

    public function edit($id)
    {
        $user = $this->model::with('roles')->find($id);
        return view('admin.pages.users.form', ['user' => $user]);
    }


    public function update(Request $request)
    {
        $attributes = [
            'name' => $request->name,
            'email' => $request->email,
            'employee_no' => $request->employee_no,
            'phone' => $request->phone,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'district' => $request->district,
            'gender' => $request->gender,
            'password' => bcrypt('mtsbd123'),
        ];
        $user = $this->model::where('id', $request->id)->update($attributes);

        $roleAttr = [
            'role_id' => $request->role_id,
            'user_id' => $request->id,
        ];
        if(!empty($request->role_user_id)){
            $roleuser = $this->roleuser::where('id', $request->role_user_id)->update($roleAttr);
        } else {
            $roleuser = $this->roleuser::create($roleAttr);
        }
        try {
            return redirect()->route('user_index')->with(['status' => 1, 'message' => 'Successfully updated']);
        } catch (\Exception $e) {
            return redirect()->route('user_edit', $request->id)->with(['status' => 0, 'message' => 'Error']);
        }
    }
    public function changePassword(Request $request){
        $password = $request->password;
        $cPassword = $request->confirm_password;
        if($password == $cPassword) {
            $attributes = [
                'password' => bcrypt($password),
            ];
            $user = $this->model::where('id', $request->id)->update($attributes);
            return redirect()->back()->with(['status' => 1, 'message' => 'Password changed Successfully']);
        }else {
            return redirect()->back()->with(['status' => 0, 'message' => 'Password and Conformed password is not matched']);
        }

    }

    public function destroy($id)
    {
        $user = $this->model::find($id);
        $user->delete();
        return redirect()->route('user_index', ['status' => 1, 'message' => 'Successfully deleted']);
    }


    /**
     * Api method
     *
     */
    public function apiGetUser(Request $request){
        $users = $this->model::get();
        $data = [];
        foreach($users as $user){
            $data []=[
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];
        }
        return json_encode($data);
    }
}
