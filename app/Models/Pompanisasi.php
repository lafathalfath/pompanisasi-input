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

    public function poktan() : BelongsTo {
        return $this->belongsTo(User::class, 'poktan_id', 'id');
    }
    
    public function pompa_refocusing() : HasOne {
        return $this->hasOne(PompaRefocusing::class);
    }

    public function pompa_abt() : HasOne {
        return $this->hasOne(PompaAbt::class);
    }
}
