<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'is_half_day',
        'total_days',
        'is_paid',
        'reason',
        'status',
        'created_by',
        'updated_by',
    ];
}
