@extends('admin.main')
@section('content')
@include('admin.content-header', ['name'=>'Products', 'key'=>'List'])
<?php
use App\Helpers\Helper;
?>
<div class="container">
<div class="row container-fluid">
    <div class="col-md-12 ">
    <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Hình Đại diện</th>
                <th scope="col">Tên Sản Phẩm</th>
                <th scope="col">Danh Mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Giá khuyến mãi</th>
                <th scope="col">Active</th>
                <th scope="col">Update</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
             @foreach($productService as  $product)
             <tr>
                <td scope="col">{{$product->id}}</td>
                <th scope="col"><img height ="50px"  src="{{$product->thumb}}"></th>
                <th scope="col">{{$product->name}}</th>
                <th scope="col">{{$product->menu->name}}</th>
                <th scope="col">{{$product->price}}</th>
                <th scope="col">{{$product->price_sale}}</th>
                <th scope="col">{!!Helper::active( $product->active)!!}</th>
                <th scope="col">{{$product->updated_at}}</th>
                <th scope="col">
                <a href="/admin/products/edit/{{$product->id}}" class="btn btn-default">Edit</a>
                <a href="#" class="btn btn-danger" onclick="removeRow({{$product->id}},'/admin/products/destroy')">Delete</a>
                </th>
                </tr>
             @endforeach
            </tbody>
            </table>
            
    </div>
    
</div>
<div class="col-md-12">
<div class="card-footer clearfix">
                {{$productService->links()}}
</div>
            
          </div>
</div>

@endsection
