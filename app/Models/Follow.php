<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $table = 'tbl_follow';
    protected $primaryKey = 'id_follow';
    protected $fillable = ['follower_id', 'following_id'];
    public $timestamps = true;

    // Relasi dengan follower
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    // Relasi dengan following
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}
