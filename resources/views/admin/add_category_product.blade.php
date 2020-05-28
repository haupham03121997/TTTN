@extends('admin_layout')
@section('admin_content')
<div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      Thêm Danh mục sản phẩm
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
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh mục</label>
                                <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô Tả Danh mục</label>
                                <textarea name="txtContent" class="form-control " id="editor1"></textarea>

                               <textarea style="resize:none " name="category_product_desc" rows="8" class="form-control" placeholder="Tên Danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="category_product_status">
                                    <option value="1">Hiện</option>
                                   
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                        </form>
                        </div>

                    </div>
                </section>

        </div>
        <script> CKEDITOR.replace('editor1'); </script>

 @endsection       