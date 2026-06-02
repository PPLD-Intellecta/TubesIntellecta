<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LiveSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'platform',
        'meeting_link',
        'scheduled_at',
        'duration_minutes',
        'status',
        'max_participants',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * Get the teacher who scheduled this session.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Get all attendances for this session.
     */
    public function attendances()
    {
        return $this->hasMany(SessionAttendance::class, 'session_id');
    }

    /**
     * Get the formatted Indonesian date time for scheduled_at.
     */
    public function getFormattedScheduleAttribute(): string
    {
        if (!$this->scheduled_at) {
            return '-';
        }

        // Convert UTC stored datetime to user timezone (WIB / Asia/Jakarta)
        $localTime = $this->scheduled_at->setTimezone('Asia/Jakarta');

        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $dayName = $days[$localTime->format('l')] ?? $localTime->format('l');
        $dayNum = $localTime->format('d');
        $monthName = $months[$localTime->format('n')] ?? $localTime->format('F');
        $year = $localTime->format('Y');
        $time = $localTime->format('H:i');

        return "{$dayName}, {$dayNum} {$monthName} {$year} - {$time} WIB";
    }

    /**
     * Get Indonesian readable platform name.
     */
    public function getPlatformNameAttribute(): string
    {
        return match ($this->platform) {
            'google_meet' => 'Google Meet',
            'zoom' => 'Zoom Meeting',
            'microsoft_teams' => 'Microsoft Teams',
            default => 'Platform Lainnya',
        };
    }

    /**
     * Get class color or icon representation based on platform.
     */
    public function getPlatformBadgeColorAttribute(): string
    {
        return match ($this->platform) {
            'google_meet' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'zoom' => 'bg-blue-50 text-blue-700 border-blue-200',
            'microsoft_teams' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            default => 'bg-purple-50 text-purple-700 border-purple-200',
        };
    }

    /**
     * Get platform logo SVG icon or letters.
     */
    public function getPlatformIconAttribute(): string
    {
        return match ($this->platform) {
            'google_meet' => '🟢 Google Meet',
            'zoom' => '🔵 Zoom',
            'microsoft_teams' => '🟣 Teams',
            default => '🔗 Link',
        };
    }
}
