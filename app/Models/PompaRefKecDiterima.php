<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PompaRefKecDiterima extends Model
{
    use HasFactory;
    protected $table = 'pompa_ref_kec_diterima';
    protected $guarded = [];

    public function pompanisasi_kec() : BelongsTo {
        return $this->belongsTo(PompanisasiKec::class, 'pompanisasi_kec_id', 'id');
    }
}
