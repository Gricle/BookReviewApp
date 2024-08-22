<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'rateable_id',
        'rateable_type',
    ];
    public function rateable(): MorphTo
    {
        return $this->morphTo();
    }
}
