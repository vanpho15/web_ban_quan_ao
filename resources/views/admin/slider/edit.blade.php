@extends('admin.main')
@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
     @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu Đề</label>
                        <input type="text" name="name" value="{{ $sliders->name }}" class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                        <label for="menu">Đường Dẫn</label>
                        <input type="text" name="url" value="{{ $sliders->url }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                        <label for="menu">Sắp Xếp</label>
                        <input type="number" name="sort_by" value="{{$sliders->sort_by}}"  class="form-control" >
            </div>


            <div class="form-group">
                
                <label for="menu">Ảnh Sản Phẩm</label>
                <input type="file"  name="file" class="form-control" id="upload" name="thumb">
                <div id="image_show">
                <a href="{{ $sliders->thumb }}" target="_blank">
                        <img src="{{ $sliders->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="{{ $sliders->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" 
                    {{$sliders->active==1? 'checked=""':''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" 
                    {{$sliders->active==0? 'checked=""':''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
        </div>
        
    </form>
@endsection

