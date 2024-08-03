<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PompaAbt extends Model
{
    use HasFactory;
    protected $table = 'pompa_abt';
    protected $guarded = [];

    public function pompanisasi() : BelongsTo {
        return $this->belongsTo(Pompanisasi::class, 'pompanisasi_id', 'id');
    }
}
