<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Userモデルとほぼ同じような内容に。理由は、Laravelの認証機能をそのまま使うため。
    use Notifiable;

    protected function redirectTo($request)
    {
        return route('dashboard.login');
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
