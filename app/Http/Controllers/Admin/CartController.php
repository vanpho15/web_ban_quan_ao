<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart){
        $this->cart = $cart;
    }
    public function index(){
        return view('admin.carts.customer',[
            'title' => 'Danh Sách Đơn Hàng',
            'customers'=>$this->cart->getcustomer()
        ]);
    }
    public function show(Customer $customer){
        $carts= $this->cart->getProductForCart($customer);
        return view('admin.carts.detail',[
            'title' => 'Chi Tiết Đơn Hàng' .$customer->name,
            'customer'=>$customer,
            'carts' =>$carts
        ]);
    }
}
