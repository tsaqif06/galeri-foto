<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaction';
    protected $primaryKey = 'id_transaction';
    protected $fillable = ['user_id', 'photo_id', 'amount', 'status_id', 'payment_status', 'stripe_payment_id'];
    public $timestamps = true;

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan photo
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    // Relasi dengan status
    public function status()
    {
        return $this->belongsTo(TransactionStatus::class, 'status_id');
    }
}
