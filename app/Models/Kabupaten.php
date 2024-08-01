<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    protected $guarded = [];
    
    public function pj_kabupaten() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function provinsi() : BelongsTo {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatan() : HasMany {
        return $this->hasMany(Kecamatan::class);
    }
}
