<?php

namespace App\Models;

use Carbon\Carbon;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;



class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['title', 'description', 'user_id', 'image'];
    protected $dates = ['deleted_at', 'created_at'];

    public function  user()
    {
        return $this->belongsTo(User::class);
    }
    protected function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d ');
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => $value ? asset('storage/' . $value) : null,
            set: fn (string $value) => $value
        );
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
