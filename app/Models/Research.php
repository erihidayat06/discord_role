<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researchs';

    protected $guarded = ['id'];

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
