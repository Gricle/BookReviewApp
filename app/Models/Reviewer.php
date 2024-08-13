<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Reviewer extends Model
{
    use HasFactory;

    protected $fillable = [
        'birth_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follow(): MorphMany
    {
        return $this->morphMany(Follow::class,'followable');
    }
    
    public function rating(): MorphMany
    {
        return $this->morphMany(Rating::class,'rateable');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


}

