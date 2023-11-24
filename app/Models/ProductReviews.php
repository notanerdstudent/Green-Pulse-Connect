<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_id',
        'product_name',
        'product_image',
        'rating',
        'slug',
        'review',
        'brand',
        'purchase_url',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'product_name'
            ]
        ];
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('product_name', 'like', $term);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
