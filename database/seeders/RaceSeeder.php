<?php

namespace Database\Seeders;

use App\Models\Inscription;
use App\Models\Race;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $races = Race::factory()->count(6)->create();

        foreach ($races as $race) {

            $inscriptions = Inscription::factory()->count(10)->create([
                'race_id' => $race->id,
            ]);
        }
    }
}
