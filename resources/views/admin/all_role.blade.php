@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
<table  class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name </th>
        <th scope="col">display</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
      
         @foreach ($listRole as $item)
         <tr>
         <th scope="row">{{ $loop->index+1 }}</th>
         <td>{{ $item->name }}</td>
         <td>{{ $item->display_name }}</td>
         <td>
            <a href="{{URL::to('/edit-role/'.$item->id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
            <a href="{{URL::to('/delete-role/'.$item->id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>     
        </td> 
         </tr>
         @endforeach 
       
      
      
    </tbody>
  </table>
</div>
@endsection       