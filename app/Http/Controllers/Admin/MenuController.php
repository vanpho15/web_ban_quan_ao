<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
class MenuController extends Controller
{
    protected $menuservice;
    public function __construct(MenuService $MenuService){
        $this->menuservice = $MenuService;
    }
    public function create(){
        return view('admin.menu.add',[
            'title' => 'Thêm danh mục',
            'menuss'=>$this->menuservice->getParent()
        ]);
    }
    //CreateFormRequest kiểm tra dữ liệu đầu vào bên form
    public function store(CreateFormRequest $request){
        $result= $this->menuservice->create($request);
        return redirect()->back();
    } 
    public function index()
    {
        return view('admin.menu.list',[
            'title' => 'Danh sách danh mục',
            'menus'=>$this->menuservice->getAll()
        ]);
    }
    public function destroy(Request $request){
        $result=$this->menuservice->destroy($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' =>'Xóa Thành Công Danh Mục'
            ]);
        }
        return response()->json([
            'error' =>true,
        ]);
    }
    public function show(Menu $menu){//khai báo use
        return view('admin.menu.edit',[
            'title' => 'Chỉnh sửa danh mục : '.$menu->name,
            'menu'=>$menu,
            'menuss'=>$this->menuservice->getParent()
        ]);
    }
       //CreateFormRequest kiểm tra dữ liệu đầu vào bên form, Menu : kiểm tra id danh mục trong cơ sở dữ liệu
    public function update(Menu $menu, CreateFormRequest $request){
        $this->menuservice->update($request, $menu );
        return redirect()->route('menus.index');
    }
    
}
