@extends('admin.main')
@section('content')
@include('admin.content-header', ['name'=>'Category', 'key'=>'List'])
<div class="container">
<div class="row container-fluid">
    <div class="col-md-12 ">
    <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên Danh Mục</th>
                <th scope="col">Active</th>
                <th scope="col">Update</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
             {!! App\Helpers\Helper::menu($menus) !!}
            </tbody>
            </table>
            
    </div>
    
</div>
<div class="col-md-12">
            {{$menus->links()}}
          </div>
</div>

@endsection
