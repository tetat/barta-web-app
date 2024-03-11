<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'post_description',
        'post_unique_id',
        'user_id',
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('post_image')
            ->singleFile();
    }
}
