<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{
    
    protected $menuservice;
    public function __construct(MenuService $MenuService){
        $this->menuservice = $MenuService;
    }
    public function index(Request $request, $id, $slug = ''){
        $menu=$this->menuservice->getID($id);
        $products=$this->menuservice->getproducts($menu, $request);
        return view('menu',[
            'title' =>$menu->name,
            'products' =>$products,
            'menu' =>$menu
        ]);
    }
}
