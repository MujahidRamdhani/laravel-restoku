<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesananDetail extends Model
{
    use HasFactory;

    protected $fillable = ["pemesanan_id","menu_id","qty","harga"];

    public function pemesanan()
    {
        return $this->belongsTo(pemesanan::class);
    }

    public function menu()
    {
        return $this->belongsTo(menu::class);
    }
    
}
