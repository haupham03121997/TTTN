@extends('admin_layout')
@section('admin_content')
<div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                     THÊM QUYỀN
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
                        <form role="form" action="{{URL::to('/update-role/'.$role->id)}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu" value="{{ $role->name }}"> 
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Display_name</label>
                               <input style="resize:none " name="display_name" rows="8" class="form-control" placeholder="Tên thương hiệu" value="{{ $role->display_name }}">
                            </div>
                           
                                @foreach ($permission as $item)
                                <div class="form-check">
                                  
                                <input {{ $listrolepermission->contains($item->id) ? 'checked':'' }} class="form-check-input" type="checkbox" value="{{ $item->id }}" name="permission[]" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                  {{ $item->display_name }}
                                </label> 
                                     </div>
                                @endforeach
                                
        
                            <button type="submit" name="add_admin" class="btn btn-info">sửa</button>
                        </form>
                        </div>

                    </div>
                </section>
                
                  
                  
        </div>

          

 @endsection       