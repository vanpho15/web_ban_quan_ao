<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartservice;
    public function __construct(CartService $cartservice){
        $this->cartservice = $cartservice;
    }
    public function index(Request $request){
        $result= $this->cartservice->create($request);
         if($result===false){
            return redirect()->back();
         }
         return redirect()->route('carts');

    }
    public function show(){
        $products= $this->cartservice->getproducts();
        return view('carts.list',[
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('carts')
            
        ]);
    }
    public function update(Request $request){
        $this->cartservice->update($request);
        return redirect()->route('carts');
    }
    public function remove($id = 0){
        $this->cartservice->remove($id);
        return redirect()->route('carts');
        
    }
    public function addcart(Request $request){
        $this->cartservice->addcart($request);
        return redirect()->back();
    }
}
