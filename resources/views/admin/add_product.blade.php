
@extends('admin_layout')
@section('admin_content')

<div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      Thêm  sản phẩm
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
                        <form role="form" action="{{ URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gía sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả sản phẩm</label>
                               <textarea style="resize:none " id="body" name="product_desc" rows="8" class="form-control" placeholder="Tên Danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả nội dung sản phẩm</label>
                               <textarea style="resize:none " name="product_content" rows="8" class="form-control" placeholder="Tên Danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Danh mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="category_id">
                                   @foreach ($cate_product as $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                   @endforeach
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Thương hiệu</label>
                                <select class="form-control input-sm m-bot15" name="brand_id">
                                    @foreach ($brand_product as $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                       @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status">
                                    <option value="1">Hiện</option>
                                   
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                        </form>
                        </div>

                    </div>
                </section>

        </div>
        {{-- <script>
            CKEDITOR.replace('body');
            
            </script> --}}
 @endsection       