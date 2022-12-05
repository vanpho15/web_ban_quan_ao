@extends('admin.main')
@section('content')
@include('admin.content-header', ['name'=>'Sliders', 'key'=>'List'])
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
                <th scope="col">Hình </th>
                <th scope="col">Tiêu Đề</th>
                <th scope="col">Đường Dẫn</th>
                <th scope="col">Sắp Xếp</th>
                <th scope="col">Active</th>
                <th scope="col">Update</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
             @foreach($sliders as  $slider)
             <tr>
                <td scope="col">{{$slider->id}}</td>
                <th scope="col">
                <a href="{{ $slider->thumb }}" target="_blank">
                        <img src="{{ $slider->thumb }}" height="50px">
                    </a>
                </th>
                <th scope="col">{{$slider->name}}</th>
                <th scope="col">{{$slider->url}}</th>
                <th scope="col">{{$slider->sort_by}}</th>
                <th scope="col">{!!Helper::active( $slider->active)!!}</th>
                <th scope="col">{{$slider->updated_at}}</th>
                <th scope="col">
                <a href="/admin/sliders/edit/{{$slider->id}}" class="btn btn-default">Edit</a>
                <a href="#" class="btn btn-danger" onclick="removeRow({{$slider->id}},'/admin/sliders/destroy')">Delete</a>
                </th>
                </tr>
             @endforeach
            </tbody>
            </table>
            
    </div>
    
</div>
<div class="col-md-12">
            {{$sliders->links()}}
          </div>
</div>

@endsection
