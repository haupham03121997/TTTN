@extends('admin_layout')
@section('admin_content')
<div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                     sửa danh mục sản phẩm
                    </header>
                    <?php 
	$message=Session::get('message');
	if($message){
		echo '<span class="text-alert">'. $message.'</span>';
		Session::put('message',null);
	}
	?>
                    <div class="panel-body">
                       @foreach ($edit_category_product as $key=>$edit_value)
                           
                      
                        <div class="position-center">

                        <form role="form" action="{{URL::to('/update-category-product')}}" method="post">
                            {{csrf_field()}}
                        <input type="hidden" name="category_product_id" value="{{$edit_value->category_id}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh mục" value="{{ $edit_value->category_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Danh mục</label>
                               <textarea style="resize:none " name="category_product_desc" rows="8" class="form-control"  placeholder="Tên Danh mục">{{ $edit_value->category_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="category_product_status">
                                    <option value="1">Hiện</option>
                                   
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật danh mục</button>
                        </form>
                        @endforeach 
                        </div>

                    </div>
                </section>

        </div>
 @endsection       