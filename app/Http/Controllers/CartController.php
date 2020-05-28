<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Cart;

class CartController extends Controller
{
    public function save_cart(Request $request){
            $product_id=$request->productid_hidden;
            $quantity=$request->qty;

            $product_info=DB::table('tbl_product')->where('product_id',$product_id)->first();
            $all_brand_product=DB::table('tbl_brand')->where('brand_status','1')->get();
            $all_category_product=DB::table('tbl_category_product')->where('category_status','1')->get();
              
                $data['id']=$product_id;
                $data['qty']=$quantity;
                $data['name']=$product_info->product_name;
                $data['price']=$product_info->product_price;
                $data['weight']='123';
                $data['options']['image']=$product_info->product_image;
                Cart::add($data);
              
           return Redirect::to('/show-cart');
    }
    public function show_cart(){
        $all_brand_product=DB::table('tbl_brand')->where('brand_status','1')->get();
        $all_category_product=DB::table('tbl_category_product')->where('category_status','1')->get();
        return \view('cart.show_cart')->with('all_brand',$all_brand_product)->with('all_category',$all_category_product);

    }
     public  function delete_to_cart($rowId){
        Cart::update($rowId,0);
         return redirect('/show-cart');
     }
     public function update_cart_quantity(Request $request){
                $rowId=$request->rowId_cart;
                $qty=$request->cart_quantity;           
                Cart::update($rowId,$qty);
                return redirect::to('show-cart');
     }
}
