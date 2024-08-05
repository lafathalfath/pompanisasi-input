<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompaRefKecDiterima extends Model
{
    use HasFactory;
    protected $table = 'pompa_ref_kec_diterima';
    protected $guarded = [];

    public function pompanisasi_kec() : HasOne {
        return $this->hasOne(PompanisasiKec::class, 'pompa_ref_kec_diterima_id', 'id');
    }
}
