<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['quiz_id', 'question_text', 'tingkat_kesulitan'];

    public const TINGKAT_KESULITAN = ['Mudah', 'Sedang', 'Sulit'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
