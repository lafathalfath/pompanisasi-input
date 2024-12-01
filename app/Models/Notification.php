<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $guarded = [];

    public function sender() : BelongsTo {
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function recipent() : BelongsTo {
        return $this->belongsTo(User::class, 'recipent', 'id');
    }
}
