@extends('admin_layout')
@section('admin_content')
<div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      Thêm Quảng lý
                    </header>
                    <?php 
	$message=Session::get('message');
	if($message){
		echo '<span class="text-alert">'. $message.'</span>';
		Session::put('message',null);
	}
	?>
                    <div class="panel-body">
                        <div class="position-center">
                        <form role="form" action="{{URL::to('/save-admin')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username </label>
                                <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">name </label>
                               <input style="resize:none " name="name" rows="8" class="form-control" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">email </label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">password </label>
                                <input  type="password" style="resize:none " name="password" rows="8" class="form-control" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                
                                <label for="exampleFormControlSelect2">chọn quyền</label>
                                
                                   <select  name="role[]" class="selectpicker" multiple title="Choose one of the following...">
                                    @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach 
                                  </select>
                                 
                             

                               
                            </div>
                            <button type="submit" name="add_admin" class="btn btn-info">Thêm</button>
                        </form>
                        </div>

                    </div>
                </section>
                
                  
                  
        </div>

          

 @endsection       