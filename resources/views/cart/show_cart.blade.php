
@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
		
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
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
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{ $item->qty }}">
									<input type="hidden" value="{{ $item->rowId }}" name="rowId_cart" class="form-control">
									<input type="submit" value="cập nhật" name="update_qty" class="btn btn-default btn-sm">
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
	</section>
	 <!--/#cart_items-->
	 <section id="do_action">
		<div class="container">
			{{-- <div class="heading"> --}}
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				{{-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
			 					</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>tổng   <span>{{ Cart::subtotal() }}</span></li>
							<li>thuế <span>{{ Cart::tax() }}</span></li>
							<li>phí <span>Free</span></li>
							<li>thành tiền <span>{{ Cart::total() }}</span></li>
						</ul>
						<?php
						$shipping_id=Session::get('shipping_id');
						$customer_id=Session::get('customer_id');
						
						if($customer_id!=NULL && $shipping_id==NULL){
							   ?>
						
						<a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Thanh toán</a>  
					   <?php 
					   
							 }elseif($customer_id!=null && $shipping_id!=null){

							 
					 
					 ?>
							 <a class="btn btn-default check_out" href="{{ URL::to('/payment') }}">Thanh toán</a> 
					 
					 <?php  
						      
						    
					  
								}else{
						   ?>
						 <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Thanh toán</a>

					   <?php 
							}
					   ?> 
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	
    @endsection  