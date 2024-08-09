<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompaRefDiterima extends Model
{
    use HasFactory;
    protected $table = 'pompa_ref_diterima';
    protected $guarded = [];

    public function pompanisasi() : BelongsTo {
        return $this->belongsTo(Pompanisasi::class, 'pompanisasi_id', 'id');
    }

    public function pompa_ref_dimanfaatkan() : HasOne {
        return $this->hasOne(PompaRefDimanfaatkan::class, 'pompa_ref_diterima_id', 'id');
    }
}
