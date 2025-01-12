<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'tbl_photo';
    protected $primaryKey = 'id_photo';
    protected $fillable = ['user_id', 'file_name', 'file_path', 'slug', 'price', 'visibility', 'views'];
    public $timestamps = true;

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tbl_photo_tag', 'photo_id', 'tag_id');
    }

    // Relasi dengan comment
    public function comments()
    {
        return $this->hasMany(Comment::class, 'photo_id');
    }

    // Relasi dengan like
    public function likes()
    {
        return $this->hasMany(Like::class, 'photo_id');
    }

    // Relasi dengan report
    public function reports()
    {
        return $this->hasMany(Report::class, 'photo_id');
    }

    // Relasi dengan favorite
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'photo_id');
    }

    // Relasi dengan transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'photo_id');
    }

    // Relasi dengan album (many-to-many)
    public function albums()
    {
        return $this->belongsToMany(
            Album::class,
            'tbl_album_photo',   // Nama tabel pivot
            'photo_id',          // Foreign key di tabel pivot untuk Photo
            'album_id'           // Foreign key di tabel pivot untuk Album
        );
    }

    // Scope untuk foto publik
    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    // Scope untuk foto private
    public function scopePrivate($query)
    {
        return $query->where('visibility', 'private');
    }
}
