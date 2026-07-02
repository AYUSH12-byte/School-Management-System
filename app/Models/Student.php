<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'course_id', 'name', 'email', 'phone', 'address', 'dob',
        'gender', 'image', 'roll_number', 'status', 'enrolled_at',
    ];

    protected $casts = [
        'dob'         => 'date',
        'enrolled_at' => 'date',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-student.jpg');
    }
}
