<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompaAbtDiterima extends Model
{
    use HasFactory;
    protected $table = 'pompa_abt_diterima';
    protected $guarded = [];

    public function pompa_abt_usulan() : BelongsTo {
        return $this->belongsTo(PompaAbtUsulan::class, 'pompa_abt_usulan_id', 'id');
    }

    public function pompa_abt_dimanfaatkan() : HasOne {
        return $this->hasOne(PompaAbtDimanfaatkan::class, 'pompa_abt_diterima_id', 'id');
    }
}
