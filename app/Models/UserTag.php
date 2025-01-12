<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    use HasFactory;

    protected $table = 'tbl_user_tag'; // Nama tabel pivot

    // Kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'tag_id',
        'created_at',
        'updated_at',
    ];

    // Disable timestamps jika tidak digunakan
    public $timestamps = true;
}
