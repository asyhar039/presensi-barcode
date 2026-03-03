<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    protected $fillable = [
        'subject_id',
        'class_id',
        'session_code',
        'date',
        'start_time',
        'end_time',
        'is_active',
    ];
}
