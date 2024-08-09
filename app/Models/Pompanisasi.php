<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pompanisasi extends Model
{
    use HasFactory;
    protected $table = 'pompanisasi';
    protected $guarded = [];

    public function desa() : BelongsTo {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function pompa_ref_diterima() : HasOne {
        return $this->hasOne(PompaRefDiterima::class, 'pompanisasi_id', 'id');
    }
    
    public function pompa_abt_usulan() : HasOne {
        return $this->hasOne(PompaAbtUsulan::class, 'pompanisasi_id', 'id');
    }
}
