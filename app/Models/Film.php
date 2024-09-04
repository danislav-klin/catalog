<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'mediator', 'film_id', 'actor_id');
    }
    
}
