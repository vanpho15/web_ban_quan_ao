<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			@php
               $sumprice=0;
			   $carts= Illuminate\Support\Facades\Session::get('carts');
            @endphp
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					
					@if($carts != 0)
					@if(count($products)> 0)
					@foreach( $products as $product)
					@php
								
								
                                $price= $product->price_sale != 0? $product->price_sale :$product->price ;
                                $priceafter= $price * $carts[$product->id];
                                $sumprice += $priceafter;
                                @endphp
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{$product->thumb}}" alt="{{$product->name}}">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							{{$product->name}}
							</a>

							<span class="header-cart-item-info">
							{{$carts[$product->id]}} X {!! App\Helpers\Helper::price($product->price,$product->price_sale) !!}
							</span>
						</div>
					</li>
					@endforeach
					
					
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: {{$sumprice}}
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
					@endif
					@endif
				</div>
			</div>
		</div>
	</div>