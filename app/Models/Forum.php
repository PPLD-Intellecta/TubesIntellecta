<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forum extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * Get the user who created this forum.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all chats in this forum.
     */
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
}
