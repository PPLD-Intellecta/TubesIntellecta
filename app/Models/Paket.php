<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function fiturs()
    {
        return $this->belongsToMany(Fitur::class, 'fitur_paket');
    }
}