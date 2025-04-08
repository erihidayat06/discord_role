<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Look;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function look()
    {
        return $this->hasOne(Look::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
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
