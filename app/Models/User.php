<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'package',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isPremium(): bool
    {
        return $this->package === 'premium';
    }

    public function studyGoals(): HasMany
    {
        return $this->hasMany(StudyGoal::class, 'student_id');
    }

    public function dailyCheckins(): HasMany
    {
        return $this->hasMany(DailyCheckin::class, 'student_id');
    }

    /**
     * Get all forums created by this user.
     */
    public function forums(): HasMany
    {
        return $this->hasMany(Forum::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function sentFeedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'teacher_id');
    }

    public function receivedFeedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'student_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}