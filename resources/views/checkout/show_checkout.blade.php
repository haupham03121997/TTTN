@extends('layout')
@section('content')
<section id="cart_items">
    @php
       $customer_id=Session::get('customer_id');
            
    @endphp
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Home</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->

      

        <div class="register-req">
            <p>Làm ơn đăng kí hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
              
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form action="{{ URL::to('/save-checkout-customer') }} " method="post">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_name" placeholder="Họ và tên">
                                <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                                <input type="text" name="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_adress" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" placeholder="phone">
                                <textarea name="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>

                                <input type="submit" value="gởi" name="send_order" class="btn btn-primary btn-sn">
                            </form>
                        </div>
                        
                    </div>
                </div>
                {{-- <div class="col-sm-4">
                    <div class="order-message">
                        <p>Ghi chú gởi hàng</p>
                        <textarea name="message"  placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>
                    </div>	
                </div>					 --}}
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

      
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

@endsection 