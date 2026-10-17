<?php

namespace App\\Models;

use Illuminate\\Database\\Eloquent\\Builder;
use Illuminate\\Database\\Eloquent\\Model;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'summary', 'description',
        'image_path', 'objectives', 'status', 'sort_order', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'objectives' => 'array',
            'published_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(function (Builder $query) {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }
}
