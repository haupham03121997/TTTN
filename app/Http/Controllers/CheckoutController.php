<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use DB;
use Mail;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Cart;
use App\Mail\ShoppingMail;
class CheckoutController extends Controller
{
    public function check_out(){
            return \view('checkout.login_checkout');
    }
    public function add_customer(Request $request){
                   $data= array();
              $data['customer_name']=$request->customer_name;  
              $data['customer_email']=$request->customer_email;
              $data['customer_phone']=$request->customer_phone;
              $data['customer_password']=md5($request->customer_password); 
           $customer_id=DB::table('tbl_customers')->insertGetId($data);
          
           Session::put('customer_id',$customer_id)  ;
           Session::put('customer_name',$request->customer_name);
           return Redirect('/checkout');  
    }
    public function checkout(){
        return view('checkout.show_checkout');
    }
    public function save_checkout_customer(Request $request){
        $data= array();
        $data['shipping_name']=$request->shipping_name;  
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_note']=$request->shipping_note;
        $data['shipping_adress']=$request->shipping_adress;
        $data['shipping_phone']=$request->shipping_phone;
        $data['customer_id']=$request->customer_id;
       
     $shipping_id=DB::table('tbl_shipping')->insertGetId($data);
    
     Session::put('shipping_id',$shipping_id)  ;
    
     return Redirect('/payment');  
          
    }
    public function payment(){
            return \view('/checkout.payment');
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $customer_emai=$request->customer_email;
        $customer_password=md5($request->customer_password);
        $result=DB::table('tbl_customers')->where('customer_email',$customer_emai)->where('customer_password',$customer_password)->first();
     
      
        if($result){
            Session::put('customer_id',$result->id); 
                return Redirect::to('/checkout');
        }else{
             return Redirect::to('/login-checkout');
             }
           
    }
    public function order_place(Request $request){
        $data= array();
        $data['payment_method']=$request->payment_option;  
        $data['payment_status']='Đang chờ xử lý';
        $payment_id=DB::table('tbl_payment')->insertGetId($data);
        // insert order
        $order_data= array();
        $order_data['customer_id']=Session::get('customer_id');  
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
       
        $order_data['order_total']=Cart::total();
        $order_data['order_status']='Đang chờ xử lý';
        $order_id=DB::table('tbl_order')->insertGetId($order_data);
        
        //insert order_details
        $order_d_data= array();
        $content=Cart::content();
        $orderdetails=[];
        foreach ($content as $key=> $item) {
        $order_d_data['order_id']=$order_id;  
        $order_d_data['product_id']=$item->id;
        $order_d_data['product_name']=$item->name;
        $order_d_data['product_price']=$item->price;
        $order_d_data['product_sales_quantity']=$item->qty;

        $result=DB::table('tbl_order_details')->insert($order_d_data);
          $orderdetails=DB::table('tbl_order_details')->where('order_id',$order_id)->get();
            }
          

       $customer_id= Session::get('customer_id');
                $customer=array();
                $customer=DB::table('tbl_customers')->where('id',$customer_id)->first('customer_name');
                $order=DB::table('tbl_order')->where('id',$order_id)->get();
            
            $get_email=DB::table('tbl_customers')->where('id',$customer_id)->get('customer_email')->first();
          $email=  $get_email->customer_email;
       
          Mail::to($email)->send(new ShoppingMail($order,$orderdetails,$customer));
        // Mail::raw('plain text message', function ($message) use($email) {
            
          
        //     $message->to($email, 'hellllo');
           
        //     $message->subject('lalalalala');
           
           
        // });
         if($data['payment_method']==1){
                   echo 'thanh toán atm';
         }else{
             Cart::destroy();
             return \view('checkout.handcash');
         }  
    }
    public function manager_order(){
            $all_order=DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.id')
            ->select('tbl_order.*','tbl_customers.customer_name')
            ->orderby('tbl_order.id','desc')->get();
               
        return view('admin.manager_order')->with('all_order',$all_order);
    }
    public function view_order($id){
        // $order_by_id=DB::table('tbl_order')
        // ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.id')
        // ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.id')
        // ->join('tbl_order_details','tbl_order.id','=','tbl_order_details.order_id')
        
        //  ->where('order_id',$id)   
        // ->select('tbl_order.*','tbl_customers.*','tbl_order_details.*')
        
        // ->get();
        // dd($order_by_id);
        
           
            $customerInfo=DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.id')
            ->select('tbl_order.*','tbl_customers.customer_name','tbl_customers.customer_phone','tbl_shipping.shipping_name','tbl_shipping.shipping_adress','tbl_shipping.shipping_phone')
            ->where('tbl_order.id','=',$id)
            ->first();
          
        $billInfo = DB::table('tbl_order')
                    ->join('tbl_order_details', 'tbl_order.id', '=', 'tbl_order_details.order_id')
                    ->leftjoin('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
                    ->where('tbl_order.id', '=', $id)
                    ->select('tbl_order.*', 'tbl_order_details.*', 'tbl_product.product_name as product_name')
                    ->get();
               
         
           return \view('admin.view_order')->with('customerInfo',$customerInfo)->with('billInfo',$billInfo);
    }
}
