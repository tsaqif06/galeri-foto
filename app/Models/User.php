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
        'name',
        'email',
        'password',
        'role_id',
        'stripe_account_id'
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
        return $this->hasMany(Photo::class, 'user_id')->orderBy('created_at', 'desc')->orderBy('id', 'desc');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tbl_user_tag', 'user_id', 'tag_id');
    }
}
