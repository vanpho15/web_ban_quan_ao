<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
class SliderController extends Controller
{
    protected $SliderService;

    public function __construct(SliderService $SliderService)
    {
        $this->SliderService = $SliderService;
    }
    public function create(){
        return view('admin.slider.add',[
            'title' => 'Thêm Slider'
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);
        $this->SliderService->insert($request);
        return redirect()->back();
    }
    public function index(){
        return view('admin.slider.list',[
            'title' => 'Danh Sách Slider',
            'sliders' =>$this -> SliderService->get()
        ]);
    }
    public function show(Slider $slider){
            return view('admin.slider.edit',[
                'title' => 'Sửa Slider',
                'sliders'=>$slider
            ]);
        }
        public function update(Request $request, Slider $slider){
            $this->validate($request,[
                'name' => 'required',
                'url' => 'required'
            ]);
            $result=$this->SliderService->update($request, $slider);
            if($result){
                return redirect()->route('sliders.list');
            }
            return redirect()->back();
        }
        public function destroy(Request $request){
            $result=$this->SliderService->destroy($request);
            if($result){
                return response()->json([
                    'error' =>false,
                    'message' =>'Xóa Thành Công Slider'
                ]);
            }
            return response()->json([
                'error' =>true
            ]);
        }
}
