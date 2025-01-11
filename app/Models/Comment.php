<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'tbl_comment';
    protected $primaryKey = 'id_comment';
    protected $fillable = ['photo_id', 'user_id', 'comment'];
    public $timestamps = true;

    // Relasi dengan photo
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
