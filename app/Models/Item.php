<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    // アプリケーション側でcreateできない値を記述する
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function getMyItemOrderByCreated_at() 
    {
        return self::orderBy('created_at', 'desc')->get();
    }

    public function users()
    {
        return $this->belongsTomany(User::class)->withTimestamps();
    }

    // public static function getAllOrderByUpdated_at()
    // {
    //     return self::orderBy('updated_at', 'desc')->get();
    // }

}
