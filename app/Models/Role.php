<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'tbl_role';
    protected $primaryKey = 'id_role';
    protected $fillable = ['name', 'description'];
    public $timestamps = true;

    // Relasi dengan users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
