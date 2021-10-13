<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function product() //商品との紐付け
    {
        return $this->belongsTo('App\Product');
    }
    
    public function user() //ユーザーとの紐付け
    {
        return $this->belongsTo('App\User');
    }
}