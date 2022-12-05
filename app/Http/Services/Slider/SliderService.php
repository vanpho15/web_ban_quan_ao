<?php
namespace App\Http\Services\Slider;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class SliderService {
    public function insert($request)
    {
        try {
            $request->except('_token');
            Slider::create($request->all());
            session()->flash('success', 'Thêm Slider thành công');
        } catch (\Exception $err) {
            session()->flash('error', 'Thêm Slider lỗi');
            \Log::info($err->getMessage());
            return  false;
        }
        return  true;
    }
    public function get( )
        {
            return Slider::orderByDesc('id')->simplePaginate(8);
        }

        public function update($request, $slider)
                {
                    try {
                        $slider->fill($request->input());
                        $slider->save();
                        session()->flash('success', 'Cập Nhật Slider thành công');
                    } catch (\Exception $err) {
                        session()->flash('error', 'Cập Nhật Slider lỗi');
                        \Log::info($err->getMessage());
                        return  false;
                    }
                    return  true;
                }
    public function destroy($request){
        $slider= Slider::where('id',$request->input('id'))->first();
        if($slider){
            Storage::delete(str_replace('storage','public',$slider->thumb));
            $slider->delete();
            return true;
        }else{
            return false;
        }
    }
    public function show()
        {
            Slider::where('active',1)->orderbyDesc('sort_by')->get();
        }
}