<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper{
 public static function menu($menus, $parent_id=0, $char=''){
    $html='';
    //bằng với parent_id=0 gán ban đầu để lấy menu cha
    foreach($menus as $key => $menu){
        if($menu -> parent_id == $parent_id){
            $html.= '
            <tr>
            <td>'. $menu->id. '</td>
            <td>'.$char. $menu->name .'</td>
            <td>'.self::active( $menu->active) .'</td>
            <td>'. $menu->updated_at .'</td>
            <td>
            <a href="/admin/menus/edit/'.$menu->id.'" class="btn btn-default">Edit</a>
             <a href="#" class="btn btn-danger" onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')">Delete</a>
            </td>
            </tr>
            ';
            unset($menus[$key]);
            //self là lấy function chính nó
            $html.=self::menu($menus,$menu->id, $char .'-- ');
        }
    }
    // dấu \ để kí tự đặc biệt phía sau
     return $html;
 } 
 public static function active($active=0 ){
    return $active==0? '<span class="btn btn-danger btn-xs">No</span>':'<span class="btn btn-success btn-xs">Yes</span>';
 }
 public static function menus($menus, $parent_id = 0) :string
 {
     $html = '';
     foreach ($menus as $key => $menu) {
         if ($menu->parent_id == $parent_id) {
             $html .= '
                 <li>
                     <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                         ' . $menu->name . '
                     </a>';

             unset($menus[$key]);

             if (self::isChild($menus, $menu->id)) {
                 $html .= '<ul class="sub-menu">';
                 $html .= self::menus($menus, $menu->id);
                 $html .= '</ul>';
             }

             $html .= '</li>';
         }
     }

     return $html;
 }

 public static function isChild($menus, $id) : bool
 {
     foreach ($menus as $menu) {
         if ($menu->parent_id == $id) {
             return true;
         }
     }

     return false;
 }
 public static function price($price =0, $pricesale=0){
    if($pricesale!=0) return '<span class="btn btn-danger btn-xs"> Sale: '.number_format($pricesale).'</span>' ;// hiển thị giá khuyến mãi bên ngoài
    if($price!=0) return  number_format($price);
    return '<a href="/lien-he.html">Liên Hệ</a>';
 }
}