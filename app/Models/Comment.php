<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['comment'];

    public function commentable():MorphOne
    {
        return $this->morphTo();
    }
}
