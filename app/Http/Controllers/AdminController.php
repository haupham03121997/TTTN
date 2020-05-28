<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\admin;
use App\Role;
use Hash;
use Session;
use App\Http\Requests\loginform;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    private $admin;
    private $role;
    function __construct(admin $admin,Role $role){
      $this->admin=$admin;
      $this->role=$role;
    }
  
    function index(){
      return view('admin_login');
    }
    function Showdashboard(){
    	return view('admin.dashboard');
    }

    function dashboard(Request $request, loginform $lg){
      $validatedData = $lg->validate([
        'admin_email' => 'required|email',
        
                 ]);

      
      $admin_email=$request->admin_email;
      $admin_password=$request->admin_password;
      if(Auth::guard('admin')->attempt(['username' => $admin_email, 'password' =>$admin_password])){
        
        Session::put('name',$request->admin_name);
        // Session::put('id',$result->admin_id);
        //  return redirect('/admin/dashboard');
        return  Redirect::to('/dashboard');
      }else{
        // return $request;
        Session::put('message','Tài khoản hoặc mật khẩu bị sai làm ơn nhập lại');
          return Redirect::to('/admin');
      }

      // $result=DB::table('tbl_admin')->where('email',$admin_email)->where('password',$admin_password)->first();
      // if($result){
      //   Session::put('admin_name',$result->name);
      //   Session::put('id',$result->id);
      //   return  Redirect::to('/dashboard');
      // }else{
        
      //   Session::put('message','Tài khoản hoặc mật khẩu bị sai làm ơn nhập lại');
      //   return Redirect::to('/admin');
      // }
    }
    function logout(){
     
      Auth::guard('admin')->logout();
      return  Redirect::to('/admin');
    }
    function all_admin(){
        $list=$this->admin->all();
        return view  ('admin.all_user',compact('list'));
    }
    public function add_admin(){
      $roles=$this->role->all();
      return view('admin.add_admin',compact('roles'));
    }
    public function save_admin(Request $request){
      $roles=$this->role->all();
      $AdminCreate=$this->admin->create([
          'username'=>$request->username,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
          'name'=>$request->name,
          
      ]);
        // $roles_id=$request->role;
      //   //  foreach($roles_id as $id){
      //   // DB::table('role_admin')->insert([
      //   //   'admin_id'=>$AdminCreate->id,
      //   //   'role_id'=>$id
      //   // ]);
      // } 
        $AdminCreate->roles()->attach($request->role);


      Session::put('message','Thêm admin  thành công');
        return view('admin.add_admin',compact('roles'));
    }
    function edit_admin($id){
      $roles=$this->role->all();
      $admin=$this->admin->findOrFail($id);
      $listroleofadmin=DB::table('role_admin')->where('admin_id',$id)->pluck('role_id');
      // print_r($listroleofadmin);
        return view('admin.edit_admin',compact('roles','admin','listroleofadmin'));
    }
    function update_admin(Request $request, $id){
      
        try{
          DB::beginTransaction();
          $this->admin->where('id',$id)->update([
          
            'email'=>$request->email,
            'name'=>$request->name
            
          ]);
          DB::table('role_admin')->where('admin_id',$id)->delete();
          $admincreate=$this->admin->find($id);
         
          $admincreate->roles()->attach($request->role);
          DB::commit();
           return redirect('/all-admin');
        }catch(\Exception $exception){
          DB::rollback();
        } 


    }
    function delete_admin($id){
      
      // try{
      //   DB::beginTransaction();
          $admin=$this->admin->find($id);
         
          $admin->delete($id);
          
          
          //delete role_id
          $admin->roles()->detach();
          
          // DB::commit();
         return redirect('/all-admin');
      // }catch(\Exception $exception){
      //   DB::rollback();
      // } 


  }
}
