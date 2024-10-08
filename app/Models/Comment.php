<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'message',
        'commentable_id',
        'commentable_type',
        'reply_id'
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Reviewer::class);
    }

}
