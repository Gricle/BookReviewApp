<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        // 'publisher_id',
        'author_id',
        'language',
        'release_date',
        'translator',

    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);  
    }

    public function reviewer()
    {
        return $this->belongsToMany(Reviewer::class);
    }

    public function follow(): MorphMany
    {
        return $this->morphMany(Follow::class,'followable');
    }

    public function rating(): MorphMany
    {
        return $this->morphMany(Rating::class,'rateable');
    }

    public function comment(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}


