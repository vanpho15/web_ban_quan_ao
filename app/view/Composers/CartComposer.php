<?php
 
namespace App\View\Composers;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartComposer{
    
    public function __construct()
    {
       
    }
 
    public function compose(View $view)
    {
        $carts= Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productid=array_keys($carts);
        $products= Product::select('id','name','price','price_sale', 'thumb')
        ->where('active',1)
        ->whereIn('id',$productid)
        ->get();
        $view->with('products',$products);
       
    }
}
