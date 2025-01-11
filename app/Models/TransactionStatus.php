<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionStatus extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaction_status';
    protected $primaryKey = 'id_transaction_status';
    protected $fillable = ['status'];
    public $timestamps = true;
}
