<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAttendance extends Model
{
    use HasFactory;

    protected $table = 'session_attendances';

    protected $fillable = [
        'session_id',
        'student_id',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /**
     * Get the live session.
     */
    public function session()
    {
        return $this->belongsTo(LiveSession::class, 'session_id');
    }

    /**
     * Get the student who attended.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
