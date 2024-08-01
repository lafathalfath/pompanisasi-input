<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    use HasFactory;
    protected $table = 'wilayah';
    protected $guarded = [];

    public function pj_wilayah() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function provinsi() : HasMany {
        return $this->hasMany(Provinsi::class);
    }
}
