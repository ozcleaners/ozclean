<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Routelist;
use App\Models\Routegroup;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->checkUserRoleTypeGlobal() == true) {
            //return view('dashboard');
            return redirect()->route('admin_dashboard');
        }else {
            return redirect()->route('frontend_user_dashboard');
        }
    }

    public function error404(){

    }
    /**Admin Dashboard */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Routelist Upload
     */
    /*
        public function uploadRoutes(){
            $routes = \Route::getRoutes()->getIterator();
            $r = [];

            foreach($routes as $route){
                //dump($route->action);
                $route_group = $route->action['key'] ?? null;
                $route_title = $route->action['title'] ?? null;
                $route_name = $route->action['as'] ?? null;
                $route_parameter = implode(',', $route->action['param']??[]) ?? null;
                $route_icon = 'far fa-folder';
                $show_menu =  $route->action['show'] ?? null;
                $dashboard_position =  $route->action['position'] ?? null;
                $show_for =  $route->action['show_for'] ?? null;

                //Route Group Insert
                $route_group_code = strtolower(str_replace(' ','', $route_group));

                $checkRouteGroup = Routegroup::where('code', $route_group_code)->first();
                if(empty($checkRouteGroup) && !empty($route_group)){
                    $insertGroup = new Routegroup();
                    $insertGroup->name = $route_group;
                    $insertGroup->code = $route_group_code;
                    $insertGroup->save();
                    $insertGroupId = $insertGroup->id;
                } else{
                    $insertGroupId = null;
                }
                if(!empty($checkRouteGroup) && !empty($route_group)){
                    $insertGroupId = $checkRouteGroup->id;
                }else {
                    $insertGroupId = null;
                }

                //matched Routelist
                $matched = Routelist::where('route_name', $route_name)->first();

                if(empty($matched) && !empty($route_title)){
                    $r []= [
                        'route_group' => $insertGroupId ?? Null,
                        'route_title' => $route_title,
                        'route_description' => $route_title,
                        'route_name' => $route_name,
                        'route_parameter' => $route_parameter,
                        'route_icon' => $route_icon,
                        'show_menu' => $show_menu,
                        'dashboard_position' => $dashboard_position,
                        'route_hash' => bcrypt($route_name),
                        'show_for' => $show_for,
                    ];
                }
            }

            if(count($r) > 0){
                Routelist::insert($r);
            };
            //Some custom code execute
            include app_path('/Helpers/Runner.php');
            return redirect()->back()->with(['status' => 1, 'message' => 'Updated Successfully']);
        }
    */

    public function uploadRoutes()
    {
        $routes = \Route::getRoutes()->getIterator();
        $r = [];
        foreach ($routes as $route) {
            $route_group = $route->action['key'] ?? null;
            $route_title = $route->action['title'] ?? null;
            $route_name = $route->action['as'] ?? null;
            $route_parameter = implode(',', $route->action['param'] ?? []) ?? null;
            $route_icon = $route->action['icon'] ?? 'far fa-folder';
            $show_menu = $route->action['show'] ?? null;
            $dashboard_position = $route->action['position'] ?? null;
            $show_for = $route->action['show_for'] ?? null;

            //Route Group Insert
            $route_group_code = strtolower(str_replace(' ', '', $route_group));
            $checkRouteGroup = Routegroup::where('code', $route_group_code)->first();

            //Route Delete From DB if route name not registered
            $hasRoute = Routelist::get();
            foreach ($hasRoute as $hs) {
                if (Route::has($hs->route_name)) {

                } else {
                    Routelist::find($hs->id)->delete();
                };
            }

            //
            if (empty($checkRouteGroup) && !empty($route_group)) {
                $insertGroup = new Routegroup();
                $insertGroup->name = $route_group;
                $insertGroup->code = $route_group_code;
                $insertGroup->save();
                $insertGroupId = $insertGroup->id;
            } else {
                $insertGroupId = Null;
            }

            if (!empty($checkRouteGroup) && !empty($route_group)) {
                $insertGroupId = $checkRouteGroup->id;
            }
            //matched Routelist
            $matched = Routelist::where('route_name', $route_name)->first();

            if (empty($matched) && !empty($route_title)) {

                $r [] = [
                    'route_group' => $insertGroupId ?? NULL,
                    'route_title' => $route_title,
                    'route_description' => $route_title,
                    'route_name' => $route_name,
                    'route_parameter' => $route_parameter,
                    'route_icon' => $route_icon,
                    'show_menu' => $show_menu,
                    'dashboard_position' => $dashboard_position,
                    'route_hash' => bcrypt($route_name),
                    'show_for' => $show_for,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        //dd($r);
        if (count($r) > 0) {
            Routelist::insert($r);
        };
        //Some custom code execute
        include app_path('/Helpers/Runner.php');
        return redirect()->back()->with(['status' => 1, 'message' => 'Route Updated Successfully']);
    }
}
