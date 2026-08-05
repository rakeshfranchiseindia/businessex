<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BxArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bx_articles')->insert([
            'article_id' => 1,
            'article_title' => 'Getting Started with Business Growth',
            'short_desc' => 'This is a sample description providing enough detail to be realistic for testing and development purposes.',
            'article_content' => 'This is a sample description providing enough detail to be realistic for testing and development purposes.',
            'author_id' => 1,
            'image_path' => 'uploads/images/sample1.jpg',
            'listing_image_path' => 'uploads/images/sample1.jpg',
            'article_tags' => 'business, startup, investment',
            'article_status' => 0,
            'seo_title' => 'Getting Started with Business Growth',
            'seo_keywords' => 'business, startup, investment',
            'seo_desc' => 'Sample description text.',
            'article_views' => 5,
            'article_comments' => 1,
            'created_by' => 1
        ]);

        DB::table('bx_articles')->insert([
            'article_id' => 2,
            'article_title' => 'Top Investment Strategies for 2025',
            'short_desc' => 'A comprehensive overview of business strategies, growth opportunities, and market trends in the current landscape.',
            'article_content' => 'A comprehensive overview of business strategies, growth opportunities, and market trends in the current landscape.',
            'author_id' => 2,
            'image_path' => 'uploads/images/sample2.jpg',
            'listing_image_path' => 'uploads/images/sample2.jpg',
            'article_tags' => 'funding, growth, strategy',
            'article_status' => 1,
            'seo_title' => 'Top Investment Strategies for 2025',
            'seo_keywords' => 'funding, growth, strategy',
            'seo_desc' => 'Another sample description.',
            'article_views' => 15,
            'article_comments' => 2,
            'created_by' => 2
        ]);

        DB::table('bx_articles')->insert([
            'article_id' => 3,
            'article_title' => 'How to Scale Your Startup',
            'short_desc' => 'Detailed analysis covering key aspects of business operations, market competition, and potential areas for expansion.',
            'article_content' => 'Detailed analysis covering key aspects of business operations, market competition, and potential areas for expansion.',
            'author_id' => 3,
            'image_path' => 'uploads/images/sample3.jpg',
            'listing_image_path' => 'uploads/images/sample3.jpg',
            'article_tags' => 'technology, innovation, market',
            'article_status' => 0,
            'seo_title' => 'How to Scale Your Startup',
            'seo_keywords' => 'technology, innovation, market',
            'seo_desc' => 'Third sample description.',
            'article_views' => 25,
            'article_comments' => 3,
            'created_by' => 3
        ]);

    }
}