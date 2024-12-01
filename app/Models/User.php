<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'role_id',
        'region_id',
        'password',
        'status_verifikasi',
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

    public function role() : BelongsTo {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function wilayah() : HasOne {
        return $this->hasOne(Wilayah::class, 'pj_id', 'id');
    }

    public function provinsi() : HasOne {
        return $this->hasOne(Provinsi::class, 'pj_id', 'id');
    }

    public function kabupaten() : HasOne {
        return $this->hasOne(Kabupaten::class, 'pj_id', 'id');
    }

    public function kecamatan() : HasOne {
        return $this->hasOne(Kecamatan::class, 'pj_id', 'id');
    }

    public function notification_send() : HasMany {
        return $this->hasMany(Notification::class, 'sender', 'id');
    }

    public function notification_recive() : HasMany {
        return $this->hasMany(Notification::class, 'recipent', 'id');
    }

    public function create_luas_tanam() : HasMany {
        return $this->hasMany(LuasTanam::class, 'created_by', 'id');
    }

    public function update_luas_tanam() : HasMany {
        return $this->hasMany(LuasTanam::class, 'updated_by', 'id');
    }

    public function create_abt_dimanfaatkan() : HasMany {
        return $this->hasMany(PompaAbtDimanfaatkan::class, 'created_by', 'id');
    }

    public function update_abt_dimanfaatkan() : HasMany {
        return $this->hasMany(PompaAbtDimanfaatkan::class, 'updated_by', 'id');
    }

    public function create_abt_diterima() : HasMany {
        return $this->hasMany(PompaAbtDiterima::class, 'created_by', 'id');
    }

    public function update_abt_diterima() : HasMany {
        return $this->hasMany(PompaAbtDiterima::class, 'updated_by', 'id');
    }

    public function create_abt_usulan() : HasMany {
        return $this->hasMany(PompaAbtUsulan::class, 'created_by', 'id');
    }

    public function update_abt_usulan() : HasMany {
        return $this->hasMany(PompaAbtUsulan::class, 'updated_by', 'id');
    }

    public function create_ref_diterima() : HasMany {
        return $this->hasMany(PompaRefDiterima::class, 'created_by', 'id');
    }

    public function update_ref_diterima() : HasMany {
        return $this->hasMany(PompaRefDiterima::class, 'updated_by', 'id');
    }

    public function create_ref_dimanfaatkan() : HasMany {
        return $this->hasMany(PompaRefDimanfaatkan::class, 'created_by', 'id');
    }

    public function update_ref_dimanfaatkan() : HasMany {
        return $this->hasMany(PompaRefDimanfaatkan::class, 'updated_by', 'id');
    }
}
