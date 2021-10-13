<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function reviews() //レビューとの紐付け、多数になるため 製品１対 レビュー多 の形に
    {
        return $this->hasMany('App\Review');
    }
}
