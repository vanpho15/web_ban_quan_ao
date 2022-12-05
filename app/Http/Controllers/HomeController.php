<?php

namespace App\Http\Controllers;

use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    protected $Slider;
    protected $Menu;
    protected $Product;

    public function __construct(SliderService $Slider, MenuService $Menu, ProductService $Product)
    {
        $this->Slider = $Slider;
        $this->Menu = $Menu;
        $this->Product = $Product;
    }

    public function index(){
        return view('home',[
            'title' =>'Shop Rose',
            'sliders'=>$this->Slider->get(),
            'menus'=>$this->Menu->show(),
            'products'=>$this->Product->show()
        ]);
    }
    public function LoadProduct(Request $request){
        $page = $request->input('page', 0);
        $result= $this->Product->show($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }
}
