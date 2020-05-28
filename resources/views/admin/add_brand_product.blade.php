@extends('admin_layout')
@section('admin_content')
<div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      Thêm Thương hiệu sản phẩm
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên thương hiệu</label>
                                <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả thương hiệu </label>
                               <textarea style="resize:none " name="brand_product_desc" rows="8" class="form-control" placeholder="Tên thương hiệu"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="brand_product_status">
                                    <option value="1">Hiện</option>
                                   
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                        </form>
                        </div>

                    </div>
                </section>

        </div>
 @endsection       