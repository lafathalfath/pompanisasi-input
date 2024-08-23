<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';
    protected $guarded = [];

    public function kecamatan() : BelongsTo {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
    
    public function luas_tanam() : HasMany {
        return $this->hasMany(LuasTanam::class, 'desa_id', 'id');
    }

    public function pompa_ref_diterima() : HasMany {
        return $this->hasMany(PompaRefDiterima::class, 'desa_id', 'id');
    }

    public function pompa_ref_dimanfaatkan() : HasMany {
        return $this->hasMany(PompaRefDimanfaatkan::class, 'desa_id', 'id');
    }

    public function pompa_abt_usulan() : HasMany {
        return $this->hasMany(PompaAbtUsulan::class, 'desa_id', 'id');
    }

    public function pompa_abt_diterima() : HasMany {
        return $this->hasMany(PompaAbtDiterima::class, 'desa_id', 'id');
    }

    public function pompa_abt_dimanfaatkan() : HasMany {
        return $this->hasMany(PompaAbtDimanfaatkan::class, 'desa_id', 'id');
    }
}
