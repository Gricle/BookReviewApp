<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviewer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'birth_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follow(): HasMany
    {
        return $this->hasMany(Follow::class);
    }
    
    public function rating(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


}

