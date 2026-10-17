<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    protected $fillable = [
        'hero_eyebrow', 'hero_heading', 'hero_intro',
        'intro_heading', 'intro_body', 'intro_supporting',
        'mission', 'vision', 'values', 'approach_heading',
        'approach_intro', 'approach_steps', 'hero_image_path',
        'intro_image_path',
    ];

    protected function casts(): array
    {
        return [
            'values' => 'array',
            'approach_steps' => 'array',
        ];
    }
}
