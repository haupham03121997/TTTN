<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests\myrequest;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class TestController extends Controller
{
   function index(){
         return view('test_view');
   }
   function get_data(Request $request){
//      //gởi nguyên html
// dd($request->all());
//    Mail::send('Html.view', $data, function ($message) {
//        $message->from('john@johndoe.com', 'John Doe');
//        $message->sender('john@johndoe.com', 'John Doe');
//        $message->to('john@johndoe.com', 'John Doe');
//        $message->cc('john@johndoe.com', 'John Doe');
//        $message->bcc('john@johndoe.com', 'John Doe');
//        $message->replyTo('john@johndoe.com', 'John Doe');
//        $message->subject('Subject');
//        $message->priority(3);
//        $message->attach('pathToFile');
//    });   
   // gởi = nhap tay
     Mail::raw('plain text message', function ($message) use($request) {
      //    $message->from('john@johndoe.com', 'John Doe');
      //    $message->sender('john@johndoe.com', 'John Doe');
         $message->to($request->email, 'test email');
      //    $message->cc('john@johndoe.com', 'John Doe');
      //    $message->bcc('john@johndoe.com', 'John Doe');
      //    $message->replyTo('john@johndoe.com', 'John Doe');
         $message->subject($request->tieude);
      //    $message->priority(3);
      //    $message->attach('pathToFile');
     });
   }
   public function get_form(Request $request){
     
      
         //   dd($request->all());
       return $request->text;
   }

}
