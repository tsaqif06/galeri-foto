<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'tbl_album';
    protected $primaryKey = 'id_album';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'visibility',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke tabel User (pemilik album).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    /**
     * Relasi ke tabel Photo melalui tabel pivot tbl_album_photo.
     */
    public function photos()
    {
        return $this->belongsToMany(
            Photo::class,
            'tbl_album_photo',   // Nama tabel pivot
            'album_id',          // Foreign key di tabel pivot untuk Album
            'photo_id'           // Foreign key di tabel pivot untuk Photo
        );
    }

    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    public function scopePrivate($query)
    {
        return $query->where('visibility', 'private');
    }
}
