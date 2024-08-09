<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompaAbtUsulan extends Model
{
    use HasFactory;
    protected $table = 'pompa_abt_usulan';
    protected $guarded = [];

    public function pompanisasi() : BelongsTo {
        return $this->belongsTo(Pompanisasi::class, 'pompanisasi_id', 'id');
    }

    public function pompa_abt_diterima() : HasOne {
        return $this->hasOne(PompaAbtDiterima::class, 'pompa_abt_usulan_id', 'id');
    }
}
