<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompanisasiKec extends Model
{
    use HasFactory;
    protected $table = 'pompanisasi_kec';
    protected $guarded = [];

    public function desa() : BelongsTo {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function pompa_ref_kec_usulan() : HasOne {
        return $this->hasOne(PompaRefKecUsulan::class, 'pompa_ref_kec_usulan_id', 'id');
    }

    public function pompa_ref_kec_diterima() : HasOne {
        return $this->hasOne(PompaRefKecDiterima::class, 'pompa_ref_kec_diterima_id', 'id');
    }

    public function pompa_ref_kec_digunakan() : HasOne {
        return $this->hasOne(PompaRefKecDigunakan::class, 'pompa_ref_kec_digunakan_id', 'id');
    }

    public function pompa_abt_kec_usulan() : HasOne {
        return $this->hasOne(PompaAbtKecUsulan::class, 'pompa_abt_kec_usulan_id', 'id');
    }

    public function pompa_abt_kec_diterima() : HasOne {
        return $this->hasOne(PompaAbtKecDiterima::class, 'pompa_abt_kec_diterima_id', 'id');
    }

    public function pompa_abt_kec_digunakan() : HasOne {
        return $this->hasOne(PompaAbtKecDigunakan::class, 'pompa_abt_kec_diterima_id', 'id');
    }
}
