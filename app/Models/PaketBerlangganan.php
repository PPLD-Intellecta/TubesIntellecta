<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketBerlangganan extends Model
{
    protected $table = 'paket_berlangganan';

    protected $fillable = [
        'nama_paket',
        'harga',
        'durasi_hari',
        'deskripsi',
        'status',
    ];  
}
