<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Example fixed records
        Testimonial::create([
            'text' => 'The BusinessEx team is very co-operative. They have personally helped me in reaching out to investors for my Edtech startup.',
            'name' => 'Manish Negi',
            'designation' => 'CEO, EasyStudy',
        ]);

        Testimonial::create([
            'text' => 'I was recommended this business by one of my friend. I am trying to look for some investors for my online clothing business...',
            'name' => 'Ghanshyam Mundra',
            'designation' => 'Works at BHEL',
        ]);

        // Generate 98 more dummy records
        for ($i = 1; $i <= 10; $i++) {
            Testimonial::create([
                'text' => 'This is testimonial number '.$i.'. '.Str::random(50),
                'name' => 'User '.$i,
                'designation' => 'Designation '.$i,
            ]);
        }
    }
}
