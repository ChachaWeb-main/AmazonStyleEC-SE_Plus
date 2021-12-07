<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MajorCategory extends Model
{
    // 子カテゴリとのリレーションを追加。
    public function categories()
    {
        return $this->hasMany('App\Category'); //親カテゴリは複数の子カテゴリに紐づけられるので、ここではhasMany。
    }
}
