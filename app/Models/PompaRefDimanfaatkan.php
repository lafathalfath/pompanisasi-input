<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PompaRefDimanfaatkan extends Model
{
    use HasFactory;
    protected $table = 'pompa_ref_dimanfaatkan';
    protected $guarded = [];

    public function pompa_ref_diterima() : BelongsTo {
        return $this->belongsTo(PompaRefDiterima::class, 'pompa_ref_diterima_id', 'id');
    }
}
