<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoTag extends Model
{
    use HasFactory;

    protected $table = 'tbl_photo_tag';
    protected $primaryKey = 'id_photo_tag';
    protected $fillable = ['photo_id', 'tag_id'];
    public $timestamps = true;

    // Relasi dengan photo
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    // Relasi dengan tag
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
