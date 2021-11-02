<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable; //laravel-favoriteで提供されているお気に入り機能を導入

class Product extends Model
{
    use Favoriteable; //お気に入り機能

    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function reviews() //レビューとの紐付け、多数になるため 製品１対 レビュー多 の形に
    {
        return $this->hasMany('App\Review');
    }
}
