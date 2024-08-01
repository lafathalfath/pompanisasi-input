<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $guarded = [];
    
    public function pj_kecamatan() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function kabupaten() : BelongsTo {
        return $this->belongsTo(Kabupaten::class);
    }
}
