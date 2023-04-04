<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title','description','user_id'];
    protected $dates = ['deleted_at','created_at'];

    public function  user()
    {
        return $this->belongsTo(User::class);
    }
    protected function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d ');
    }
    public function comments():MorphMany
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
