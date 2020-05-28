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

      

      

      
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
            <div class="table-responsive cart_info">
				@php
				$content=Cart::content();
				 
					@endphp
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total(đ)</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach ($content as $item)
						<tr>
						
								
						
							<td class="cart_product">
								<a  href=""><img src="{{ URL::to('public/upload/product/'.$item->options->image)}}" width="50" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $item->name }}</a></h4>
								
							</td>
							<td class="cart_price">
								<p>{{ $item->price }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{ URL::to('/update-cart-quantity') }}" method="post" >
                                        {{ csrf_field() }}
                                    <p>{{ $item->qty }} </p>
									{{-- <input class=""  name="cart_quantity" value="{{ $item->qty }}"> --}}
									<input type="hidden" value="{{ $item->rowId }}" name="rowId_cart" class="form-control">
									{{-- <input type="submit" value="cập nhật" name="update_qty" class="btn btn-default btn-sm"> --}}
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"> 
										@php
											$subtotal=$item->price*$item->qty;
											
											echo  number_format($subtotal)
										@endphp

								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ URL::to('/delete-to-cart/'.$item->rowId) }}"><i class="fa fa-times"></i></a>
							</td>
							
						</tr>
						@endforeach
						
						
					</tbody>
				</table>
			</div>
        </div>

      <form method="post" action="{{ URL::to('/order-place') }}">
        {{ csrf_field() }}
        <div class="payment-options">
            <h4 style="margin: 40px font-size=20px">Chọn hình thức thanh toán</h4>

                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
           
                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sn">
            </div>
      </form> 
    </div>

</section> <!--/#cart_items-->

@endsection 