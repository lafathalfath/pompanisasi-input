<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PompaAbtDiterima extends Model
{
    use HasFactory;
    protected $table = 'pompa_abt_diterima';
    protected $guarded = [];

    public function desa() : BelongsTo {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }

    public function create_by() : BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function update_by() : BelongsTo {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
