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

    public function pompanisasi() : HasMany {
        return $this->hasMany(Pompanisasi::class);
    }
    
    public function luas_tanam() : HasMany {
        return $this->hasMany(LuasTanam::class, 'desa_id', 'id');
    }
}
