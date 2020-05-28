@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
     Thông tin người mua
      </div>
      
      <div class="table-responsive">
          <?php 
	$message=Session::get('message');
	if($message){
		echo '<span class="text-alert">'. $message.'</span>';
		Session::put('message',null);
	}
  ?>
   
        
   
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên người đặt</th>
              <th>Sđt</th>
              
              
            </tr>
          </thead>
          <tbody>
             
            <tr>
             
              
              <td>{{ $customerInfo->customer_name}}</td>
              <td>{{ $customerInfo->customer_phone}}</td>
              
            </tr>
            
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
 <br><br> 
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
     Thông tin vận chuyển
      </div>
      
      <div class="table-responsive">
          <?php 
	$message=Session::get('message');
	if($message){
		echo '<span class="text-alert">'. $message.'</span>';
		Session::put('message',null);
	}
	?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên người vận chuyển</th>
              <th>Địa chỉ</th>
              <th>sđt</th>
              
            </tr>
          </thead>
          <tbody>
             
            <tr>
             
              
              <td>{{ $customerInfo->shipping_name}}</td>
              <td>{{ $customerInfo->shipping_adress}}</td>
              <td>{{ $customerInfo->shipping_phone}}</td>
            </tr>
            
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
<br><br>  
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
      liệt kê chi tiết đơn hàng
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
          <?php 
	$message=Session::get('message');
	if($message){
		echo '<span class="text-alert">'. $message.'</span>';
		Session::put('message',null);
	}
	?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Gía</th>
              <th>Thành tiền</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($billInfo as $bill)
             
            <tr>

                  
              
              <td>{{ $bill->product_name }}</td>
              <td>{{ $bill->product_sales_quantity }}</td>
              <td>{{number_format( $bill->product_price )}}</td>
              <td>{{number_format( $bill->product_price*$bill->product_sales_quantity  )}}</td>
            
             
             
            </tr>
            @endforeach
            <tr style="margin-top:5px">
              <td>Tổng tiền(đ)</td>
              <td></td>
              <td></td>
              <td >{{ $customerInfo->order_total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">Trạng thái đơn hàng</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <div class="form-group">
              <form action="{{ URL::to('/change-order/'.$customerInfo->id) }}" method="get">
              <select class="form-control" id="sel1" name="order_status">
                <option  value="0" >Chờ xử lý</option>
                <option value="1">Tiến hành vận chuyển</option>
                <option value="2">Hoàn thành</option>
              </select>
              <button type="submit" class="btn btn-primary">Thay đổi</button>
              </form>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection       