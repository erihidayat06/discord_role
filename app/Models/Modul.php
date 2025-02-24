<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Kelas (Many-to-One)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function look()
    {
        return $this->hasOne(Look::class);
    }
}
