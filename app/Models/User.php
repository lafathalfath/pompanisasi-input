<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'role',
        'password',
    ];

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
    ];

    public function wilayah() : HasOne {
        return $this->hasOne(Wilayah::class, 'pj_id', 'id');
    }

    public function provinsi() : HasOne {
        return $this->hasOne(Provinsi::class, 'pj_id', 'id');
    }

    public function kabupaten() : HasOne {
        return $this->hasOne(Kabupaten::class, 'pj_id', 'id');
    }

    public function cpcl() : HasOne {
        return $this->hasOne(Cpcl::class, 'poktan_id', 'id');
    }

    public function pompanisasi() : HasOne {
        return $this->hasOne(Pompanisasi::class, 'poktan_id', 'id');
    }
}
