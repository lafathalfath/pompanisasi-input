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


    public function pompa_abt_diterima() : BelongsTo {
        return $this->belongsTo(PompaAbtDiterima::class, 'pompa_abt_diterima_id', 'id');
    }
}
