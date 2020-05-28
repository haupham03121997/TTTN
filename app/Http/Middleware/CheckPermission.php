<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     * @param  string|null  $guard
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission=null,$guard='')
    {
            //lay tat ca cac quyen ki admin dn he thong
            //1.lay role cua admin
            $listRoleAdmin = DB::table('admin')
            ->join('role_admin', 'admin.id', '=', 'role_admin.admin_id')
            ->join('roles', 'role_admin.role_id', '=', 'roles.id')
           
            ->where('admin.id',(Auth::guard('admin')->user()->id))
            ->select('roles.*')
            ->get()->pluck('id')->toArray();
            // if(Auth::guard('admin')->check()){
            //   dd(Auth::guard('admin')->user()->id);
            // }
            //2.lay cac permission 
            $listRoleAdmin = DB::table('roles')
            ->join('role_permission', 'roles.id', '=', 'role_permission.role_id')
            ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
         
            ->whereIn('roles.id',$listRoleAdmin)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();
            //  dd($listRoleAdmin);
              $checkPermission=DB::table('permissions')->where('name',$permission)->value('id');  
                // dd($checkPermission);
                
                 
              if($listRoleAdmin->contains($checkPermission)){
                return $next($request);
              }  

            return abort(404);
        // return $next($request);
    }
}
