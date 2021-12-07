<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product'); //このコードでカテゴリ内の無数の商品を、容易に取得することができるように
    }
    
    // 親カテゴリ(Major)とのリレーション。
    public function major_category()
    {
        return $this->belongsTo('App\MajorCategory'); //子カテゴリは1つの親カテゴリに属するので、ここではbelongsTo。
    }
}
