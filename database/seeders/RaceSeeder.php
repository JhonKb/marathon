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
                continue;
            }

            $raceDateTime = $race->date_time;
            $maxStartRace = (clone $raceDateTime)->modify('+30 minutes');

            $raceCycle = RaceCycle::factory()->create([
                'race_id' => $race->id,
                'start_race' => fake()->dateTimeBetween($raceDateTime, $maxStartRace)
            ]);

            $this->callWith(QrCodeCaptureSeeder::class, ['race1' => $race, 'inscriptions1' => $inscriptions, 'raceCycle1' => $raceCycle]);
        }
    }
}
