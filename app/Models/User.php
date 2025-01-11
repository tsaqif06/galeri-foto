<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

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
        return $this->hasMany(Photo::class, 'user_id');
    }
}
