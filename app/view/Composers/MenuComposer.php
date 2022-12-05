<?php
 
namespace App\View\Composers;
use Illuminate\View\View;
use App\Models\Menu;

class MenuComposer{
    
    public function __construct()
    {
       
    }
 
    public function compose(View $view)
    {
        $menus= Menu::select('id','name','parent_id')->where('active',1)->orderbyDesc('id')->get();
        $view->with('menus',$menus);
    }
}
//menus là biến nhận giá trị $menus ở trên để truyền sang header và header sẽ truyền vào function của helper