<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilWeb extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    protected static function booted()
    {
        parent::boot();

        // Global scope untuk filter website_id
        static::addGlobalScope('website', function ($query) {
            if (session()->has('website_id')) {
                $query->where('website_id', session('website_id'));
            }
        });

        // Set website_id saat create
        static::creating(function ($model) {
            if (session()->has('website_id')) {
                $model->website_id = session('website_id');
            }
        });

        // Set website_id saat update (optional tergantung kebutuhan)
        static::updating(function ($model) {
            if (session()->has('website_id')) {
                $model->website_id = session('website_id');
            }
        });
    }
}
