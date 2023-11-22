<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'user_id',
        'name',
        'details',
        'slug',
        'location',
        'website',
        'email',
        'is_offline',
        'phone',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
