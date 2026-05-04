<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
     protected $fillable = [
        'nama_fitur',
        'deskripsi',
    ];

    public function paketUsers()
    {
        return $this->belongsToMany(PaketUser::class, 'paket_user_fitur');
    }
}
