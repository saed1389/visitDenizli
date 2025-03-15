<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Housing extends Model
{
    protected $guarded = [];

    public function county() : BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
