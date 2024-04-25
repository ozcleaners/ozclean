<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WarehousePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){ 
            //Check If permission is route of this role
            
            //Current user role of current warehouse

            $user_id = Auth::user()->id;
            
            $cr = Auth::user()->checkUserWarehouseAccess($user_id);

            
            //Check Request Route
            $route = Route::getRoutes()->match($request);
            $currentroute = $route->getName();


             //Check Request Route with Current user Role 
             if(auth()->user()->checkUserRoleTypeGlobal() == true){
                $check = true;
            }else {
                $crole = array($cr->role_id);
                $request->attributes->add(['authUserRole' => $crole]);
                $check = auth()->user()->checkRoute($crole, $currentroute) ?? null;
            }

            
            //dd(auth()->user()->routeList(array($cr->role_id)));
            if($check == null){
                $request->attributes->add(['hasPermission' => $check]);
            }else{
                $request->attributes->add(['hasPermission' => $cr]);
            }


            return $next($request);
        } else {
            return redirect()->route('login');
        }
        //return $next($request);
    }
}
