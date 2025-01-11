<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'tbl_report';
    protected $primaryKey = 'id_report';
    protected $fillable = ['photo_id', 'user_id', 'reason_id'];
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

    // Relasi dengan reason
    public function reason()
    {
        return $this->belongsTo(ReportReason::class, 'reason_id');
    }
}
