<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompaAbtKecUsulan extends Model
{
    use HasFactory;
    protected $table = 'pompa_abt_kec_usulan';
    protected $guarded = [];

    public function pompanisasi_kec() : HasOne {
        return $this->hasOne(PompanisasiKec::class, 'pompa_abt_kec_usulan_id', 'id');
    }
}
