<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cpcl extends Model
{
    use HasFactory;
    protected $table = 'cpcl';
    protected $guarded = [];

    public function desa() : BelongsTo {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function poktan() : BelongsTo {
        return $this->belongsTo(User::class, 'poktan_id', 'id');
    }
}
