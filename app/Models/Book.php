<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;
use App\Models\Author;
use App\Models\wishlists;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'slug',
        'ibsn',
        'publish_year',
        'rate',
        'book',
        'author_id',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlists::class);
    }
}
