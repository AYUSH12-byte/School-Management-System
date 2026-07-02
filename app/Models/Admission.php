<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    protected $fillable = [
        'course_id', 'name', 'email', 'phone', 'address', 'dob',
        'gender', 'previous_school', 'qualification', 'message', 'status', 'reviewed_at',
    ];

    protected $casts = [
        'dob'         => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
