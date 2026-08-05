<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('industry_categories')->insert([
            'cat_id' => 1,
            'category_name' => 'Sample string data',
            'category_slug' => 'sample-slug-1',
            'parent_id' => 1,
            'category_status' => 0
        ]);

        DB::table('industry_categories')->insert([
            'cat_id' => 2,
            'category_name' => 'Another sample entry',
            'category_slug' => 'sample-slug-2',
            'parent_id' => 2,
            'category_status' => 1
        ]);

        DB::table('industry_categories')->insert([
            'cat_id' => 3,
            'category_name' => 'Third sample value',
            'category_slug' => 'sample-slug-3',
            'parent_id' => 3,
            'category_status' => 0
        ]);

    }
}