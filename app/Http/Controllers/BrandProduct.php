<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
}
public function all_brand_product(){
   $all_brand_product=DB::table('tbl_brand')->get();
//   $manager_category_product=view('admin.all_category_product')->with('all_category_product',$all_category_product);
  return view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    // return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
}
public function save_brand_product(Request $request){
    $data=array();
    $data['brand_name']=$request->brand_product_name;
    $data['brand_desc']=$request->brand_product_desc;
    $data['brand_status']=$request->brand_product_status;
    
    DB::table('tbl_brand')->insert($data);
    Session::put('message','Thêm thương hiệu sản phẩm thành công');
     return redirect('add-brand-product');
}
public function active_brand_product($brand_product_id){
  DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
  Session::put('message','không kích  hoạt thương hiệu sản phẩm thành công');
  return redirect::to('all-brand-product');
}
public function unactive_brand_product($brand_product_id){
  DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
  Session::put('message',' kích  hoạt thương hiệu sản phẩm thành công');
  return redirect::to('all-brand-product');
}
public function edit_brand_product($brand_product_id){
  $edit_brand_product=  DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
  $manager_brand_product=view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
   return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
}
public function update_brand_product(Request $request){
    $data=array();
    // $data['category_id']=$request->category_product_id;
    $data['brand_name']=$request->brand_product_name;
    $data['brand_desc']=$request->brand_product_desc;
    $data['brand_status']=$request->brand_product_status;
    DB::table('tbl_brand')->where('brand_id',$request->brand_product_id)->update($data);
    Session::put('message','update thành công');
    return redirect::to('all-brand-product');
}
public function delete_brand_product($brand_product_id){
DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
Session::put('message',' xóa sản phẩm thành công');
return redirect::to('all-brand-product');
    }
    //end admin page
    public function Show_brand_home($brand_id){
      $all_brand_product=DB::table('tbl_brand')->where('brand_status','1')->get();
      $all_category_product=DB::table('tbl_category_product')->where('category_status','1')->get();
      $brand_by_id=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->paginate(3);
      $brand_name=DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();   
   
      return view('pages.brand.show_brand')->with('all_brand',$all_brand_product)->with('all_category',$all_category_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
     }
}
