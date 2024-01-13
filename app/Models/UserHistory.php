<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'viewed_user_id',
        'viewed_at',
    ];

    public function viewedUser()
    {
        // User モデルとのリレーションを定義
        return $this->belongsTo(User::class, 'viewed_user_id');
    }
}
