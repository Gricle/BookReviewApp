<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable=[
        'address',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->hasMany(Book::class);
        
    }

    public function rating(): MorphMany
    {
        return $this->morphMany(Rating::class,'rateable');
    }

    public function follow(): MorphMany
    {
        return $this->morphMany(Follow::class,'followable');
    }

    public function comment(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
