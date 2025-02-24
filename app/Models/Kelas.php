<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $guarded = ['id'];

    public function moduls()
    {
        return $this->hasMany(Modul::class);
    }

    public function look()
    {
        return $this->belongsTo(Look::class);
    }


    // Scope untuk filter berdasarkan kategori_id dari request
    public function scopeKategori($query)
    {
        if (request()->has('kategori')) {
            return $query->where('kategori_id', request('kategori'));
        }

        return $query;
    }

    // Scope untuk pencarian berdasarkan judul kelas
    public function scopeSearch($query, $keyword)
    {
        return $keyword ? $query->where('judul', 'like', "%{$keyword}%") : $query;
    }
}
