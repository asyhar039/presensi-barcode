<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property Carbon|null $birth_date
 */
class Student extends Model
{
    protected $fillable = [
        'nis',
        'name',
        'class',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
