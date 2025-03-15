<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class County extends Model
{
    protected $guarded = [];

    // Relationship with News
    public function news():HasMany
    {
        return $this->hasMany(News::class);
    }

    // Relationship with Events
    public function events():HasMany
    {
        return $this->hasMany(Event::class);
    }
}
