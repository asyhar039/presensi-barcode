<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'attendance_session_id',
        'status',
        'scan_time',
    ];
}
