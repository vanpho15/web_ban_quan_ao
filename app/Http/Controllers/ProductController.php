<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id, $slug=''){
        $product= $this->productService->showdeltail($id);
        $productsmore= $this->productService->more($id,$product);
        return view('products.content',[
            'title' => $product->name,
            'product' => $product,
            'productsmore' => $productsmore
        ]);
    }
}
