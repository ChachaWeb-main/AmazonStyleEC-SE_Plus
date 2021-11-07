<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable; //laravel-favoriteで提供されているお気に入り機能を導入
use Kyslik\ColumnSortable\Sortable; //インストールしたcolumn-sortableを使用できるように

class Product extends Model
{
    use Favoriteable, Sortable; //モデルでお気に入り機能, ソート機能ができるように
    
    //ソートする対象を指定
    public $sortable = [
        'price', 
        'updated_at'
    ];
    
    //リレーション
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function reviews() //レビューとの紐付け、多数になるため 製品１対 レビュー多 の形に
    {
        return $this->hasMany('App\Review');
    }
}
