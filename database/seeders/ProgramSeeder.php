<?php

namespace Database\\Seeders;

use App\\Models\\Program;
use Illuminate\\Database\\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Food & Essential Assistance',
                'slug' => 'essential-support',
                'category' => 'Essential support',
                'summary' => 'Support that responds to immediate practical needs while maintaining dignity and respectful community engagement.',
                'description' => 'Support that responds to identified essential needs with care, transparency and respectful community engagement.',
                'image_path' => 'assets/images/food-support.webp',
                'objectives' => ['Respond to identified essential needs.', 'Coordinate support transparently.'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Children & Family Wellbeing',
                'slug' => 'children-families',
                'category' => 'Children & families',
                'summary' => 'Keeping children and families visible in community support efforts, with attention to dignity, care and inclusion.',
                'description' => 'Keep children and families visible in community support efforts, with attention to dignity, care, inclusion and safe participation.',
                'image_path' => 'assets/images/children.webp',
                'objectives' => ['Center children and family needs in support conversations.', 'Strengthen safe, respectful community participation.'],
                'sort_order' => 2,
            ],
            [
                'title' => 'Community Outreach',
                'slug' => 'outreach',
                'category' => 'Outreach',
                'summary' => 'Building relationships through direct engagement, community gatherings and practical support activities.',
                'description' => 'Build relationships through direct engagement, community gatherings and practical support activities informed by community priorities.',
                'image_path' => 'assets/images/outreach.webp',
                'objectives' => ['Listen to community priorities.', 'Connect people with appropriate support.'],
                'sort_order' => 3,
            ],
            [
                'title' => 'Community Development',
                'slug' => 'development',
                'category' => 'Community development',
                'summary' => 'Supporting practical local action and participation as part of a longer-term approach to stronger communities.',
                'description' => 'Support practical local action and participation as part of a longer-term approach to stronger communities.',
                'image_path' => 'assets/images/field-work.webp',
                'objectives' => ['Encourage community participation.', 'Support practical local initiatives where appropriate.'],
                'sort_order' => 4,
            ],
        ];

        foreach ($programs as $program) {
            Program::firstOrCreate(['slug' => $program['slug']], $program + [
                'status' => 'published',
                'published_at' => now(),
            ]);
        }
    }
}
