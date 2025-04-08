<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class News extends Model
{
    use Searchable;
    protected $guarded = [];

    public function county() : BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
