<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Government extends Model
{
    protected $guarded = [];

    public function county() : BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function title() : BelongsTo
    {
        return $this->belongsTo(GovernmentTitle::class, 'governmentTitle_id', 'id');
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
