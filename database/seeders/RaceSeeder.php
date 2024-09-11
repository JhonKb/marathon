<?php

namespace Database\Seeders;

use App\Models\Inscription;
use App\Models\Race;
use App\Models\RaceCycle;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $races = Race::factory()->count(3)->create();

        foreach ($races as $race) {

            $inscriptions = Inscription::factory()->count(10)->create([
                'race_id' => $race->id,
            ]);

            if ($race->status !== 'Closed Registrations') {
                break;
            }

            $raceCycle = RaceCycle::factory()->create([
                'race_id' => $race->id,
            ]);

            $this->callWith(RaceResultSeeder::class, ['race' => $race, 'inscriptions' => $inscriptions, 'raceCycle' => $raceCycle]);
        }
    }
}
