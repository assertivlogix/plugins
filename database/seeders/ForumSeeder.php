<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumCategory;
use App\Models\ForumTopic;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Support\Str;

class ForumSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Categories
        $categories = [
            [
                'name' => 'General Discussion',
                'description' => 'General talk about anything related to Assertivlogix.',
                'color' => '#3b82f6',
                'order' => 1
            ],
            [
                'name' => 'Security Plugins',
                'description' => 'Support and discussion for security products.',
                'color' => '#ef4444',
                'order' => 2
            ],
            [
                'name' => 'SEO Tools',
                'description' => 'Discussion about SEO optimization and our plugins.',
                'color' => '#10b981',
                'order' => 3
            ],
            [
                'name' => 'Announcements',
                'description' => 'Official news and updates from the team.',
                'color' => '#f59e0b',
                'order' => 0
            ]
        ];

        foreach ($categories as $cat) {
            ForumCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'],
                'color' => $cat['color'],
                'order' => $cat['order'],
            ]);
        }

        // 2. Create a Dummy User if none exists (usually there's an admin)
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@assertivlogix.com',
                'password' => bcrypt('password'),
            ]);
        }

        // 3. Create Sample Topics
        $generalCat = ForumCategory::where('slug', 'general-discussion')->first();
        $seoCat = ForumCategory::where('slug', 'seo-tools')->first();

        // Topic 1
        $topic1 = ForumTopic::create([
            'user_id' => $user->id,
            'forum_category_id' => $generalCat->id,
            'title' => 'Welcome to the new community forum!',
            'slug' => 'welcome-to-the-new-community-forum',
            'is_pinned' => true,
            'views_count' => 125
        ]);
        
        ForumPost::create([
            'forum_topic_id' => $topic1->id,
            'user_id' => $user->id,
            'content' => "Welcome everyone! This is the place to share your thoughts, ask questions, and help each other out.\n\nPlease be respectful and enjoy the community."
        ]);

        // Topic 2
        $topic2 = ForumTopic::create([
            'user_id' => $user->id,
            'forum_category_id' => $seoCat->id,
            'title' => 'Best practices for SEO Pro 2.0',
            'slug' => 'best-practices-for-seo-pro-2-0',
            'views_count' => 45
        ]);

        ForumPost::create([
            'forum_topic_id' => $topic2->id,
            'user_id' => $user->id,
            'content' => "I've been using SEO Pro 2.0 and the new sitemap feature is amazing. Does anyone have tips for the keyword analysis tool?"
        ]);
        
        // Reply to Topic 2
        ForumPost::create([
            'forum_topic_id' => $topic2->id,
            'user_id' => $user->id,
            'content' => "Yes! Make sure you connect your Google Search Console account first. It makes the keyword data much more accurate."
        ]);
    }
}
