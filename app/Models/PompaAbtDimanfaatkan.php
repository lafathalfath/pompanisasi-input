<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PompaAbtDimanfaatkan extends Model
{
    use HasFactory;
    protected $table = 'pompa_abt_dimanfaatkan';
    protected $guarded = [];

    public function desa() : BelongsTo {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }
}
