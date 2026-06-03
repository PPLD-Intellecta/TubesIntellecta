<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyCheckin extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'checkin_date',
        'is_completed',
        'study_minutes',
        'notes',
    ];

    protected $casts = [
        'checkin_date' => 'date',
        'is_completed' => 'boolean',
        'study_minutes' => 'integer',
    ];

    /**
     * Get the student that owns the daily checkin.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
