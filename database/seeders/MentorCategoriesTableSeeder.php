<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $categories = collect(config('mentorCategoriesConfig', []))
            ->map(fn (array $category): array => [
                'mentor_category_id' => (int) $category['cat_id'],
                'mentor_category_name' => $category['category_name'],
                'category_slug' => $category['category_slug'],
                'mentor_parent_id' => (int) ($category['parent_id'] ?? 0),
                'mentor_category_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->values()
            ->all();

        foreach (array_chunk($categories, 100) as $chunk) {
            DB::table('mentor_categories')->upsert(
                $chunk,
                ['mentor_category_id'],
                ['mentor_category_name', 'category_slug', 'mentor_parent_id', 'mentor_category_status', 'updated_at']
            );
        }

        $this->command?->info('Seeded '.count($categories).' mentor categories.');
    }
}
