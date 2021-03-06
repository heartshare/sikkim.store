<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['raw_original_price'];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function getPriceAttribute()
    {
        return '₹ '.($this->attributes['price'] / 100);
    }

    public function getOriginalPriceAttribute(): string
    {
        return '₹ '.(($this->attributes['price']/ 100) + 20);
    }

    public function getRawOriginalPriceAttribute()
    {
        return $this->attributes['price'] / 100;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFeaturedImageAttribute()
    {
        return "https://picsum.photos/200?random=".$this->attributes['uuid'];
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }

    public function relatedProducts()
    {
        return $this->newQuery()->whereHas('store', function ($query) {
            $query->where('slug', $this->store->slug);
        })->whereHas('category', function ($query){
            $query->where('name', $this->category->name);
        } )->latest()
            ->take(8)->with('category')
            ->get();
    }
}
