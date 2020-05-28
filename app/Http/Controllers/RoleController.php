<?php

namespace App\Http\Controllers;
use App\Role;
use DB;

use App\Permission;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class RoleController extends Controller
{
    //
    private $role;
    private $permission;
    function __construct(Role $role, Permission $permission){
        $this->role=$role;
        $this->permission=$permission;
    }
    function all_role(){
            $listRole=$this->role->all();
            return view('admin.all_role',compact('listRole'));
    }
    public function add_role(){
        $permission=$this->permission->all();
        return view('admin.add_role',compact('permission'));
      }
      public function save_role(Request $request){
        try{
            DB::beginTransaction();
        $RoleCreate=$this->role->create([
            'name'=>$request->name,
            
            
            'display_name'=>$request->display_name,
            
        ]);
          $RoleCreate->permission()->attach($request->permission);
  
  
        Session::put('message','Thêm admin  thành công');
        DB::commit();
         return redirect('add-role');
        }catch(\Exception $exception){
            DB::rollback();
          } 
      }
      function edit_role($id){
        $permission=$this->permission->all();
        $role=$this->role->findOrFail($id);
        // $admin=$this->admin->findOrFail($id);
        $listrolepermission=DB::table('role_permission')->where('role_id',$id)->pluck('permission_id');
        
        // // print_r($listroleofadmin);
          // return view('admin.edit_role',compact('roles','admin','listroleofadmin'));
          return view('admin.edit_role',compact('permission','role','listrolepermission'));
      }

      function update_role(Request $request, $id){
      
        try{
          DB::beginTransaction();
          $this->role->where('id',$id)->update([
          
            'name'=>$request->name,
            'display_name'=>$request->display_name
            
          ]);
          DB::table('role_permission')->where('role_id',$id)->delete();
          $rolecreate=$this->role->find($id);
         
          $rolecreate->permission()->attach($request->permission);
          DB::commit();
           return redirect('/all-role');
        }catch(\Exception $exception){
          DB::rollback();
        } 


    }
    function delete_role($id){
      
      // try{
      //   DB::beginTransaction();
          $role=$this->role->find($id);
         
          $role->delete($id);
          
          
          //delete role_id
          $role->permission()->detach();
          
          // DB::commit();
         return redirect('/all-role');
      // }catch(\Exception $exception){
      //   DB::rollback();
      // } 


  }
}
