<?php

namespace Database\Seeders;

use App\Models\SitePageContent;
use Illuminate\Database\Seeder;

class SitePageContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => [
                'page_title' => 'Home page',
                'hero_eyebrow' => 'Muhamadi R Charity Foundation Uganda',
                'hero_heading' => 'Compassion in action. Hope in community.',
                'hero_intro' => 'We are committed to community-centered support that protects dignity, responds to practical needs and helps people move forward with hope.',
                'hero_image_path' => 'assets/images/hero-community.webp',
                'sections' => [
                    ['eyebrow'=>'Our values','title'=>'People first. Community centered. Dignity driven.','body'=>'Our work is guided by compassion, accountability and long-term hope. Human needs stay at the center, local relationships matter, and support should be delivered responsibly.','image_path'=>'assets/images/community-support.webp','items'=>[
                        ['title'=>'Compassion','description'=>'Responding to human needs with care.'],['title'=>'Community','description'=>'Local relationships and participation matter.'],['title'=>'Accountability','description'=>'Transparent, responsible action.'],['title'=>'Long-term hope','description'=>'Support that can grow with communities.']]],
                    ['eyebrow'=>'In the community','title'=>'People, action and hope in motion.','body'=>'A glimpse of the people and community-centered work represented in the foundation’s field photographs.','image_path'=>'assets/images/community-group.webp','items'=>[
                        ['title'=>'Support begins with people.','description'=>'Creating space for practical support, connection and dignity.'],['title'=>'Responding to practical needs.','description'=>'Meeting immediate needs with care, respect and a human-centered approach.'],['title'=>'Participation strengthens communities.','description'=>'Encouraging people to shape the conversations and actions that shape support.'],['title'=>'Turning compassion into action.','description'=>'Working alongside communities through practical, responsive and respectful support.']]],
                    ['eyebrow'=>'Who we are','title'=>'A charity built around people, not statistics.','body'=>'Muhamadi R Charity Foundation Uganda works from a simple conviction: practical support is most meaningful when it protects dignity and responds to the realities people face. The supplied field photographs show community gatherings, food and essential support, outreach and people working together.','image_path'=>'assets/images/children.webp','items'=>[
                        ['title'=>'Listen','description'=>'Listen to community needs before shaping support.'],['title'=>'Respect','description'=>'Deliver assistance with dignity and respect.'],['title'=>'Connect','description'=>'Build relationships that can strengthen local action.']]],
                    ['eyebrow'=>'What we do','title'=>'Practical support with a human face.','body'=>'Broad areas of work reflected in the supplied materials. Exact program names, locations and objectives can be refined as official information is added.','image_path'=>'assets/images/food-support.webp','items'=>[
                        ['title'=>'Food & Essential Support','description'=>'Responding to practical needs with care, respect and community participation.'],['title'=>'Children & Families','description'=>'Keeping children and families visible within community-centered support efforts.'],['title'=>'Community Outreach','description'=>'Connecting with people and creating space for shared action.'],['title'=>'Community Development','description'=>'Supporting practical, community-led efforts that can strengthen local resilience.']]],
                    ['eyebrow'=>'How we make a difference','title'=>'A simple, accountable way of working.','body'=>'A clear framework for turning compassion into practical community support.','image_path'=>'assets/images/field-work.webp','items'=>[
                        ['title'=>'Listen','description'=>'Understand the needs and priorities people identify.'],['title'=>'Mobilize','description'=>'Bring people, resources and relationships together.'],['title'=>'Respond','description'=>'Deliver practical support with dignity and care.'],['title'=>'Empower','description'=>'Create room for participation, agency and local action.'],['title'=>'Learn','description'=>'Document what works and improve future support.']]],
                    ['eyebrow'=>'Get involved','title'=>'There is a place for you in the work.','body'=>'Whether you want to support a community initiative, volunteer time, explore a partnership or help amplify the mission, start the conversation. Together, practical support can become lasting hope.','image_path'=>'assets/images/support-action.webp','items'=>[
                        ['title'=>'Support our work','description'=>'Explore ways to contribute to community-centered initiatives.'],['title'=>'Volunteer','description'=>'Share your time, skills and experience.'],['title'=>'Start a conversation','description'=>'Contact the foundation about collaboration or support.']]],
                ],
            ],
            'impact' => [
                'page_title'=>'Impact page','hero_eyebrow'=>'Our impact','hero_heading'=>'Make the impact visible. Keep the evidence honest.','hero_intro'=>'This page is designed for verified figures, project records and community stories. No statistics should be presented as fact until the organization supplies and approves them.','hero_image_path'=>'assets/images/community-group.webp',
                'sections'=>[
                    ['eyebrow'=>'Impact framework','title'=>'From activity to evidence.','body'=>'A future impact report can connect resources, activities, outputs and longer-term outcomes without overstating what the evidence shows.','image_path'=>'assets/images/field-work.webp','items'=>[
                        ['title'=>'Need','description'=>'Document the problem and who is affected.'],['title'=>'Action','description'=>'Record what support or activity took place.'],['title'=>'Reach','description'=>'Track verified people, households or communities reached.'],['title'=>'Outcome','description'=>'Describe changes supported by credible evidence.'],['title'=>'Learn','description'=>'Use findings to improve future work.']]],
                    ['eyebrow'=>'Stories from the field','title'=>'Evidence also has a human voice.','body'=>'Approved project records and field stories help explain the people, work and context behind reported outcomes.','image_path'=>'assets/images/support-action.webp','items'=>[
                        ['title'=>'Community comes together','description'=>'A visual record of people gathering, participating and sharing a common community space.'],['title'=>'Practical support in action','description'=>'Photographs document hands-on support and community engagement around practical needs.'],['title'=>'Participation matters','description'=>'Meaningful community work is strengthened when people participate and are seen.']]],
                    ['eyebrow'=>'Ready for real reporting','title'=>'Turn this page into an annual impact report.','body'=>'Add verified totals, project locations, beneficiary definitions, dates, methodology, stories and approved testimonials. Reported figures should be supported by records and reviewed before publication.','image_path'=>'assets/images/community-group.webp','items'=>[
                        ['title'=>'People reached','description'=>'Publish only a verified figure and explain its measurement.'],['title'=>'Families supported','description'=>'Record the reporting period and how households are counted.'],['title'=>'Projects and initiatives','description'=>'Connect public summaries to documented activities and outcomes.']]],
                ],
            ],
            'stories' => [
                'page_title'=>'Stories page','hero_eyebrow'=>'Stories & news','hero_heading'=>'Stories from people and communities.','hero_intro'=>'Approved articles, field stories and announcements from the foundation. Stories are published only after review by an authorised editor.','hero_image_path'=>'assets/images/community-group.webp',
                'sections'=>[
                    ['eyebrow'=>'Field notes','title'=>'The people behind the work.','body'=>'Community gatherings, practical assistance, outreach and participation are part of the visual story represented in the foundation’s field photographs. Add verified dates, locations and approved details before publishing specific claims.','image_path'=>'assets/images/community-support.webp','items'=>[
                        ['title'=>'Community comes together','description'=>'A visual record of people gathering, participating and sharing a common community space.'],['title'=>'Practical support in action','description'=>'Hands-on support and community engagement around practical needs.'],['title'=>'Participation matters','description'=>'Community work is strengthened when people participate and are seen.']]],
                    ['eyebrow'=>'Share an update','title'=>'Have a story to share?','body'=>'Contact the foundation with a proposed story, approved photographs or an update about community activity. Personal stories and images should be shared with appropriate permission.','image_path'=>'assets/images/women-community.webp','items'=>[
                        ['title'=>'Contact the team','description'=>'Send a message with relevant context and contact details.']]],
                ],
            ],
            'contact' => [
                'page_title'=>'Contact page','hero_eyebrow'=>'Contact us','hero_heading'=>'Let’s start a conversation.','hero_intro'=>'Have a question, want to learn more about the foundation, or wish to discuss support or collaboration? Send a message and the team can review your enquiry.','hero_image_path'=>'assets/images/community-support.webp',
                'sections'=>[
                    ['eyebrow'=>'Get in touch','title'=>'We welcome your message.','body'=>'Use the contact form to share your question, feedback or request. Please include enough detail for the team to understand how best to respond.','image_path'=>'assets/images/field-work.webp','items'=>[
                        ['title'=>'General enquiries','description'=>'Questions about the foundation and its work.'],['title'=>'Volunteering and support','description'=>'Ask about contributing time, skills or resources.'],['title'=>'Partnership conversations','description'=>'Share an idea or request a discussion.']]],
                    ['eyebrow'=>'Before you send','title'=>'Help us respond clearly.','body'=>'Provide a valid email address and a clear subject. Do not include sensitive personal information unless it is necessary for your enquiry.','image_path'=>'assets/images/community-group.webp','items'=>[]],
                ],
            ],
            'get-involved' => [
                'page_title'=>'Get involved page','hero_eyebrow'=>'Get involved','hero_heading'=>'Be part of practical community support.','hero_intro'=>'There are different ways to contribute: offer your time, share skills, discuss a partnership or make a donation pledge. Every expression of interest is reviewed by the team.','hero_image_path'=>'assets/images/support-action.webp',
                'sections'=>[
                    ['eyebrow'=>'Ways to help','title'=>'Choose how you would like to contribute.','body'=>'Support should respond to identified needs and be coordinated responsibly. Contact the foundation if you would like to discuss the best way to help.','image_path'=>'assets/images/food-support.webp','items'=>[
                        ['title'=>'Donate','description'=>'Record a donation pledge. Pledges remain pending until payment is verified by an administrator.'],['title'=>'Volunteer','description'=>'Tell us about your interests, availability and skills. Applications are reviewed by the team.'],['title'=>'Collaborate','description'=>'Start a conversation about a community initiative or potential partnership.']]],
                    ['eyebrow'=>'Volunteer with us','title'=>'Share your time and skills.','body'=>'Complete the volunteer application with your area of interest and motivation. The team can review the details and follow up.','image_path'=>'assets/images/women-community.webp','items'=>[]],
                    ['eyebrow'=>'Make a donation pledge','title'=>'Support work that puts people first.','body'=>'Enter the amount and preferred payment method. This form records a pledge only; it does not process payment or automatically issue a receipt. Payment must be confirmed by the foundation.','image_path'=>'assets/images/food-support.webp','items'=>[]],
                ],
            ],
        ];

        foreach ($pages as $key => $page) {
            SitePageContent::updateOrCreate(['page_key' => $key], $page);
        }
    }
}
