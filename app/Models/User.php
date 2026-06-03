<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'package',
    ];

    /**
     * Check if the user has a premium package.
     */
    public function isPremium(): bool
    {
        return $this->package === 'premium';
    }

    /**
     * Get the study goals for the user.
     */
    public function studyGoals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StudyGoal::class, 'student_id');
    }

    /**
     * Get the daily checkins for the user.
     */
    public function dailyCheckins(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DailyCheckin::class, 'student_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
