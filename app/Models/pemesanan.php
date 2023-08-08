<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;
    protected $fillable = ["kodeTransaksi","namaPelanggan","status","totalHarga'"];
    public function pemesanan_detail()
    {
        return $this->hasMany(pemesananDetail::class);
    }
}
