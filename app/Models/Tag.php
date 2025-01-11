<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tbl_tag';
    protected $primaryKey = 'id_tag';
    protected $fillable = ['name'];
    public $timestamps = true;

    // Relasi dengan photos
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'tbl_photo_tag', 'tag_id', 'photo_id');
    }
}
