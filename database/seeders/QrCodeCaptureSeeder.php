<?php

namespace Database\Seeders;

use App\Models\QrCodeCapture;
use Illuminate\Database\Seeder;

class QrCodeCaptureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($race1, $inscriptions1, $raceCycle1): void
    {
        $race = $race1;
        $inscriptions = $inscriptions1;
        $raceCycle = $raceCycle1;

        $lastCaptureInstant = null;

        foreach ($inscriptions as $inscription) {
            $averagePace = rand(3, 6);
            $previousCaptureInstant = $raceCycle->start_race;
            $turns = $race->turns;

            for ($turn = 1; $turn <= $turns; $turn++) {
                $distancePerTurn = $race->total_distance_km / $turns;
                $timePerTurn = $distancePerTurn * $averagePace;

                $captureInstant = (clone $previousCaptureInstant)->modify('+' . (int)$timePerTurn . ' minutes');
                $turnResult = $captureInstant->diff($previousCaptureInstant);

                QrCodeCapture::factory()->create([
                    'race_id' => $inscription->race_id,
                    'inscription_id' => $inscription->id,
                    'turn' => $turn,
                    'capture_instant' => $captureInstant,
                    'turn_result' => $turnResult->format("%H:%I:%S"),
                ]);

                $previousCaptureInstant = $captureInstant;

                if ($turn === $turns) {
                    if ($lastCaptureInstant === null || $captureInstant > $lastCaptureInstant) {
                        $lastCaptureInstant = $captureInstant;
                    }
                }
            }
        }
        $raceCycle->update([
            'end_race' => $lastCaptureInstant,
        ]);
    }
}
