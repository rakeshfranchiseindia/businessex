<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BxCitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        // State codes match constants.statesIndia and profile_business.ofc_state.
        $cities = [
            ['city' => 'Amaravati', 'state' => 'AP'], ['city' => 'Itanagar', 'state' => 'AR'],
            ['city' => 'Dispur', 'state' => 'AS'], ['city' => 'Patna', 'state' => 'BR'],
            ['city' => 'Raipur', 'state' => 'CG'], ['city' => 'Panaji', 'state' => 'GA'],
            ['city' => 'Gandhinagar', 'state' => 'GJ'], ['city' => 'Chandigarh', 'state' => 'CH'],
            ['city' => 'Shimla', 'state' => 'HP'], ['city' => 'Ranchi', 'state' => 'JH'],
            ['city' => 'Bengaluru', 'state' => 'KA'], ['city' => 'Thiruvananthapuram', 'state' => 'KL'],
            ['city' => 'Bhopal', 'state' => 'MP'], ['city' => 'Mumbai', 'state' => 'MH'],
            ['city' => 'Imphal', 'state' => 'MN'], ['city' => 'Shillong', 'state' => 'ML'],
            ['city' => 'Aizawl', 'state' => 'MZ'], ['city' => 'Kohima', 'state' => 'NL'],
            ['city' => 'Bhubaneswar', 'state' => 'OR'], ['city' => 'Amritsar', 'state' => 'PB'],
            ['city' => 'Jaipur', 'state' => 'RJ'], ['city' => 'Gangtok', 'state' => 'SK'],
            ['city' => 'Chennai', 'state' => 'TN'], ['city' => 'Hyderabad', 'state' => 'TS'],
            ['city' => 'Agartala', 'state' => 'TR'], ['city' => 'Dehradun', 'state' => 'UK'],
            ['city' => 'Lucknow', 'state' => 'UP'], ['city' => 'Kolkata', 'state' => 'WB'],
            ['city' => 'Srinagar', 'state' => 'JK'], ['city' => 'New Delhi', 'state' => 'DL'],
            ['city' => 'Port Blair', 'state' => 'AN'], ['city' => 'Silvassa', 'state' => 'DH'],
            ['city' => 'Daman', 'state' => 'DD'], ['city' => 'Kavaratti', 'state' => 'LD'],
            ['city' => 'Puducherry', 'state' => 'PY'],
        ];

        $now = now();
        $rows = collect($cities)->values()->map(function (array $city, int $index) use ($now): array {
            return [
                'id' => $index + 1,
                'city' => $city['city'],
                'state' => $city['state'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        })->all();

        DB::table('bx_cities')->upsert($rows, ['id'], ['city', 'state', 'updated_at']);
        $this->command?->info('Seeded '.count($rows).' cities.');

    }
}