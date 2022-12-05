<?php
namespace App\Http\Services\Menu;
use Illuminate\Support\Str;
use App\Models\Menu;
class MenuService {
    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }
    public function getAll(){
        return Menu::orderbyDesc('id')->simplePaginate(10);
    }
    public function create($request){
        try{
                Menu::create([
                'name' =>(string) request()->input('name'),
                'parent_id' =>(int) request()->input('parent_id'),
                'description' =>(string) request()->input('description'),
                'content' =>(string) request()->input('content'),
                'slug' =>(string) Str::slug(request()->input('name')),
                'active'=>(int) request()->input('active')
            ]);
            session()->flash('success','Tạo Thành Công');
        }catch(\Exception $err){//bắt lỗi trùng slug vì undique
            session()->flash('error','Không Tạo Thành Công');
            return false;
        }
        return true;
    }
    public function destroy($request){
        $id=(int) $request->input('id');
        $menu=Menu::where('id',$id)->first();
        if($menu){
            return Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
            
        }
        return false;
    }
    public function update($request, $menu):bool
    {
        if($request->input('parent_id') != $menu->id){
            $menu->parent_id =(int) $request->input('parent_id');
        }
        $menu->name =(string) $request->input('name');
        
        $menu->description =(string) $request->input('description');
        $menu->content =(string) $request->input('content');
        $menu->active=(int) $request->input('active');
        $menu->save();
        session()->flash('success','Cập nhập thành công danh mục');
        return true;
    }
    public function show(){
        return Menu::select('name','id')->where('active',1)->where('parent_id',0)->orderbyDesc('id')->get();
    }
    public function getID($id){
        return Menu::where('id',$id)->where('active',1)->firstOrFail();
    }
    public function getproducts($menu, $request){
        $query = $menu->products()
        ->select('id', 'name', 'price', 'price_sale', 'thumb')
        ->where('active', 1);
    if ($request->input('price')) {
        $query->orderBy('price_sale', $request->input('price'), 'price', $request->input('price'));
    }

    return $query
        ->orderByDesc('id')
        ->paginate(12)
        ->withQueryString();
    }
}