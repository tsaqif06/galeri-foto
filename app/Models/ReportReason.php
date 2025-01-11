<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReason extends Model
{
    use HasFactory;

    protected $table = 'tbl_report_reason';
    protected $primaryKey = 'id_report_reason';
    protected $fillable = ['reason'];
    public $timestamps = true;
}
