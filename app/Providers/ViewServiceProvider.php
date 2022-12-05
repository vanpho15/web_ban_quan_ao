<?php
 
namespace App\Providers;
 
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\MenuComposer;
use App\View\Composers\CartComposer;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
 
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       view::composer('header', MenuComposer::class);
       view::composer('cart', CartComposer::class);
    }
}