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

    /**
     * Scope to automatically set the website_id based on the domain.
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            // Set website_id saat create
            $model->website_id = session('website_id');
        });

        static::updating(function ($model) {
            // Set website_id saat update
            $model->website_id = session('website_id');
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('website', function ($query) {
            if (session()->has('website_id')) {
                $query->where('website_id', session('website_id'));
            }
        });
    }
}
