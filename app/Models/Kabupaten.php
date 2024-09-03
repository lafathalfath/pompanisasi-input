<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    protected $guarded = [];

    public function pj() : BelongsTo {
        return $this->belongsTo(User::class, 'pj_id', 'id');
    }

    public function provinsi() : BelongsTo {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kecamatan() : HasMany {
        return $this->hasMany(Kecamatan::class);
    }

    public function starter_ref_diterima_kabupaten() : HasOne {
        return $this->hasOne(StarterRefDiterimaKabupaten::class, 'kabupaten_id', 'id');
    }

    public function starter_ref_dimanfaatkan_kabupaten() : HasOne {
        return $this->hasOne(StarterRefDimanfaatkanKabupaten::class, 'kabupaten_id', 'id');
    }

    public function starter_abt_usulan_kabupaten() : HasOne {
        return $this->hasOne(StarterAbtUsulanKabupaten::class, 'kabupaten_id', 'id');
    }

    public function starter_abt_diterima_kabupaten() : HasOne {
        return $this->hasOne(StarterAbtDiterimaKabupaten::class, 'kabupaten_id', 'id');
    }

    public function starter_abt_dimanfaatkan_kabupaten() : HasOne {
        return $this->hasOne(StarterAbtDimanfaatkanKabupaten::class, 'kabupaten_id', 'id');
    }

    public function starter_luas_tanam_kabupaten() : HasOne {
        return $this->hasOne(StarterLuasTanamKabupaten::class, 'kabupaten_id', 'id');
    }
}
