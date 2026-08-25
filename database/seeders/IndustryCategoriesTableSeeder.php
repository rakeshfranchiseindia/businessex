<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustryCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $categories = collect(config('industryCategoriesConfig', []))
            ->map(fn (array $category): array => [
                'cat_id' => (int) $category['cat_id'],
                'category_name' => $category['category_name'],
                'category_slug' => $category['category_slug'],
                'parent_id' => (int) ($category['parent_id'] ?? 0),
                'category_status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->values()
            ->all();

        foreach (array_chunk($categories, 100) as $chunk) {
            DB::table('industry_categories')->upsert(
                $chunk,
                ['cat_id'],
                ['category_name', 'category_slug', 'parent_id', 'category_status', 'updated_at']
            );
        }

        $this->command?->info('Seeded '.count($categories).' industry categories.');
    }
}
