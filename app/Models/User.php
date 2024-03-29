<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'group_id',
        'post_id',
        'description',
        'profile_photo_path',
        'qr_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'user_id', 'skill_id')->withTimeStamps();
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'hobby_user', 'user_id', 'hobby_id')->withTimeStamps();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function followings()
    {
        return $this->belongsToMany(self::class, "follows", "user_id", "following_id")->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, "follows", "following_id", "user_id")->withTimestamps();
    }

    public function userTweets()
    {
        return $this->hasMany(Tweet::class);
    }
}
