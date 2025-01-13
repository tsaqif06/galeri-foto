<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'profile_picture',
        'role_id',
        'stripe_account_id',
        'description'
    ];
    protected $hidden = [
        'password',
    ];
    public $timestamps = true;

    // Relasi dengan role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relasi dengan foto
    public function photos()
    {
        return $this->hasMany(Photo::class, 'user_id')
            ->orderBy('created_at', 'desc')
            ->orderBy('id_photo', 'desc');
    }

    // Relasi dengan tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tbl_user_tag', 'user_id', 'tag_id');
    }

    // Relasi dengan followers
    public function followers()
    {
        return $this->belongsToMany(User::class, 'tbl_follow', 'following_id', 'follower_id')->withTimestamps();
    }

    // Relasi dengan followings
    public function followings()
    {
        return $this->belongsToMany(User::class, 'tbl_follow', 'follower_id', 'following_id')->withTimestamps();
    }

    // Relasi dengan favorite (many-to-many dengan Photo)
    public function favorites()
    {
        return $this->belongsToMany(Photo::class, 'tbl_favorite', 'user_id', 'photo_id')->withTimestamps();
    }

    // Relasi dengan album
    public function albums()
    {
        return $this->hasMany(Album::class, 'user_id');
    }
}
