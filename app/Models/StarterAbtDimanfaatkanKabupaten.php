<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StarterAbtDimanfaatkanKabupaten extends Model
{
    use HasFactory;
    protected $table = 'starter_abt_dimanfaatkan_kabupaten';
    protected $guarded = [];

    public function kabupaten() : BelongsTo {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }
}
