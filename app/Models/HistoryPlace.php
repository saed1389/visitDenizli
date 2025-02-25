<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryPlace extends Model
{
    protected $guarded = [];

    public function county() : BelongsTo
    {
        return $this->belongsTo(County::class);
    }
}
