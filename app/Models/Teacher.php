<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = [
        'department_id', 'name', 'email', 'phone', 'qualification',
        'designation', 'image', 'bio', 'experience_years', 'is_active', 'is_featured',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-teacher.jpg');
    }
}
