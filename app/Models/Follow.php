<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // public static function getAllOrderByUpdated_atForLoggedInUser($userId)
    // {
    //     $userData = self::where('user_id', $userId)
    //         ->orderBy('updated_at', 'desc')
    //         ->get();

    //     $followingData = self::where('following_id', $userId)
    //         ->orderBy('updated_at', 'desc')
    //         ->get();

    //     return [
    //         'userData' => $userData,
    //         'followingData' => $followingData
    //     ];
    // }

    public static function getAllOrderByUpdated($userId)
    {
        return self::with(['user', 'following'])
            ->where('user_id', $userId)
            ->orWhere('following_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
