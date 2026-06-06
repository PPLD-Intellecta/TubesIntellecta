<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $fillable = [
        'message',
        'user_id',
        'forum_id',
    ];

    /**
     * Get the user who sent this chat message.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the forum this chat belongs to.
     */
    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }
}
