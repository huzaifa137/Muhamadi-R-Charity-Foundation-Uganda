<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitePageContent extends Model
{
    protected $fillable = [
        'page_key', 'page_title', 'hero_eyebrow', 'hero_heading',
        'hero_intro', 'hero_image_path', 'sections',
    ];

    protected function casts(): array
    {
        return ['sections' => 'array'];
    }
}
