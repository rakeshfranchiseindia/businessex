<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoContentTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        foreach (range(1, 10) as $number) {
            DB::table('bx_author')->upsert([
                [
                    'author_id' => $number,
                    'author_name' => "BusinessEx Author {$number}",
                    'author_email' => "author{$number}@businessex.test",
                    'author_desig' => 'Business Content Writer',
                    'author_dept' => 'Editorial',
                    'is_active' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ], ['author_id'], ['author_name', 'author_email', 'author_desig', 'author_dept', 'is_active', 'updated_at']);

            DB::table('bx_articles')->upsert([
                [
                    'article_id' => $number,
                    'article_title' => "Business Growth Strategy {$number}",
                    'short_desc' => 'Practical insights for building, funding, and scaling a stronger business.',
                    'article_content' => 'This demonstration article provides useful business growth guidance for local development and testing.',
                    'author_id' => $number,
                    'image_path' => 'images/default-article.jpg',
                    'listing_image_path' => 'images/default-article.jpg',
                    'article_tags' => 'business, growth, strategy',
                    'article_status' => 1,
                    'seo_title' => "Business Growth Strategy {$number}",
                    'seo_keywords' => 'business growth strategy',
                    'seo_desc' => 'BusinessEx business growth insights.',
                    'article_views' => $number * 5,
                    'article_comments' => 0,
                    'created_by' => $number,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ], ['article_id'], ['article_title', 'short_desc', 'article_content', 'author_id', 'image_path', 'listing_image_path', 'article_status', 'updated_at']);

            DB::table('bx_news')->upsert([
                [
                    'news_id' => $number,
                    'news_title' => "BusinessEx Market Update {$number}",
                    'short_desc' => 'The latest business, investment, and startup developments from the BusinessEx community.',
                    'news_content' => 'This demonstration news item provides market context for local development and testing.',
                    'author_id' => $number,
                    'image_path' => 'images/default-article1.jpg',
                    'listing_image_path' => 'images/default-article1.jpg',
                    'news_tags' => 'business, investment, startup',
                    'news_status' => 1,
                    'seo_title' => "BusinessEx Market Update {$number}",
                    'seo_keywords' => 'business investment startup news',
                    'seo_desc' => 'BusinessEx market news and updates.',
                    'news_views' => $number * 4,
                    'news_comments' => 0,
                    'created_by' => $number,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ], ['news_id'], ['news_title', 'short_desc', 'news_content', 'author_id', 'image_path', 'listing_image_path', 'news_status', 'updated_at']);
        }

        $this->command?->info('Seeded 10 authors, 10 articles, and 10 news items.');
    }
}
