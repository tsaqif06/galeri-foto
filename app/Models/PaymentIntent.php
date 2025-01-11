<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentIntent extends Model
{
    use HasFactory;

    protected $table = 'tbl_payment_intent';
    protected $primaryKey = 'id_payment_intent';
    protected $fillable = ['user_id', 'photo_id', 'amount', 'status', 'stripe_payment_intent_id'];
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
}
