<?php

namespace Database\Seeders;

use App\Models\AboutPageContent;
use Illuminate\Database\Seeder;

class AboutPageContentSeeder extends Seeder
{
    public function run(): void
    {
        AboutPageContent::firstOrCreate(['id' => 1], [
            'hero_eyebrow' => 'About the foundation',
            'hero_heading' => 'People, dignity and community at the center.',
            'hero_intro' => 'A clear, human introduction to Muhamadi R Charity Foundation Uganda — written from the supplied visual materials and intentionally free of unverified institutional claims.',
            'intro_heading' => 'A community-centered charity presence in Uganda.',
            'intro_body' => 'Muhamadi R Charity Foundation Uganda is presented here as an organization committed to charitable support, outreach and human dignity.',
            'intro_supporting' => 'The available photographs show community gatherings, practical assistance, children and families, outreach activities and people participating together. Official written organizational details can be added as they are confirmed.',
            'mission' => 'To support people and communities through compassionate, practical and dignity-centered action, while creating opportunities for participation and stronger local relationships.',
            'vision' => 'A future where communities are better equipped to face hardship, protect human dignity and create pathways toward hope and opportunity.',
            'values' => [
                ['title' => 'Compassion', 'description' => 'Responding to people with empathy, care and respect.'],
                ['title' => 'Integrity', 'description' => 'Acting honestly and responsibly in how support is delivered.'],
                ['title' => 'Participation', 'description' => 'Recognizing community members as participants, not passive recipients.'],
                ['title' => 'Sustainability', 'description' => 'Looking beyond immediate assistance toward stronger local capacity.'],
            ],
            'approach_heading' => 'Listen first. Act responsibly. Learn continuously.',
            'approach_intro' => 'A credible charity needs more than good intentions. It needs a disciplined approach to understanding needs, mobilizing support, communicating clearly and learning from experience.',
            'approach_steps' => [
                ['title' => 'Listen', 'description' => 'Start with people and the needs they identify.'],
                ['title' => 'Mobilize', 'description' => 'Coordinate practical resources and community relationships.'],
                ['title' => 'Deliver', 'description' => 'Provide support with dignity and care.'],
                ['title' => 'Learn', 'description' => 'Capture lessons and improve future action.'],
            ],
            'hero_image_path' => 'assets/images/hero-community.webp',
            'intro_image_path' => 'assets/images/project.webp',
        ]);
    }
}
