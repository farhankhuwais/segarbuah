<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'compare_price',
        'sale_price',
        'sale_starts_at',
        'sale_ends_at',
        'stock',
        'sku',
        'unit',
        'weight_in_grams',
        'origin',
        'is_organic',
        'is_seasonal',
        'storage_info',
        'min_order',
        'image',
        'images',
        'is_active',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_organic' => 'boolean',
            'is_seasonal' => 'boolean',
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'sale_starts_at' => 'datetime',
            'sale_ends_at' => 'datetime',
            'weight_in_grams' => 'decimal:2',
            'min_order' => 'decimal:2',
        ];
    }

    public function scopeActiveSale($query)
    {
        return $query->whereNotNull('sale_price')
            ->where('sale_starts_at', '<=', now())
            ->where('sale_ends_at', '>=', now());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating(): float
    {
        return (float) $this->reviews()->avg('rating');
    }

    public function reviewsCount(): int
    {
        return $this->reviews()->count();
    }

    public function wishlistedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }
}
