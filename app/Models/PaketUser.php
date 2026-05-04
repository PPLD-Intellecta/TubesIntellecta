<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketUser extends Model
{
    protected $fillable = [
        'nama_paket',
        'deskripsi',
    ];

    public function fiturs()
    {
        return $this->belongsToMany(Fitur::class, 'paket_user_fitur');
    }
}
