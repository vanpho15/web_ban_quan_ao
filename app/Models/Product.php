<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb'
    ];
    public function menu(){
        return $this->hasOne(Menu::class, 'id','menu_id')
        ->withDefault(['name'=>'']);
    }/*with là liên kết vs function bên model product, withDefault xóa danh mục thì sản phẩm để trống chỗ danh mục */
}
