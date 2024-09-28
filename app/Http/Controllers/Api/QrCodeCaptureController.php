<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Requests\QrCodeCaptureRequest;
use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\QrCodeCapture;
use App\Models\Race;
use DateTime;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class QrCodeCaptureController extends Controller
{
    private ?Race $race;
    private ?Inscription $inscription;
    private ?QrCodeCapture $lastCapture;

    /**
     * Store a newly created resource in storage.
     */
    public function store(QrCodeCaptureRequest $request)
    {
        $this->race = Race::find($request->race_id);

        $this->inscription = Inscription::where('race_id', $this->race->id)->find($request->inscription_id);

        if ($response = $this->checkRunnerBelongsRace()) {
            return $response;
        }

        $this->lastCapture = $this->getLatestCapture($request->inscription_id);

        if ($response = $this->checkRaceHasInProgress()) {
            return $response;
        }

        if ($response = $this->validateCheckpoint($request)) {
            return $response;
        }

        if ($response = $this->checkIfRunnerTerminatedRace()) {
            return $response;
        }

        DB::beginTransaction();

        try {
            QrCodeCapture::create([
                'race_id' => $request->race_id,
                'inscription_id' => $request->inscription_id,
                'lap' => $this->calculateLapCapture(),
                'checkpoint' => $request->checkpoint,
                'capture_instant' => $request->capture_instant,
                'time' => $this->calculateTime($request->capture_instant),
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Capture created successfully'
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @return JsonResponse|null
     */
    private function checkRunnerBelongsRace(): ?JsonResponse
    {
        if (!$this->inscription) {
            return response()->json([
                'status' => false,
                'message' => 'The runner does not belong in the race'
            ], 400);
        }
        return null;
    }

    /**
     * @return JsonResponse|null
     */
    private function checkRaceHasInProgress(): ?JsonResponse
    {
        if ($this->race->status !== 'In Progress') {
            return response()->json([
                'status' => false,
                'message' => 'Race has not in progress'
            ], 400);
        }
        return null;
    }

    /**
     * @param $request
     * @return JsonResponse|null
     */
    private function validateCheckpoint($request): ?JsonResponse
    {
        if (!$this->lastCapture && $request->checkpoint !== 1) {
            return response()->json([
                'status' => false,
                'message' => 'Checkpoint is invalid'
            ], 400);
        }
        return null;
    }

    /**
     * @return JsonResponse|null
     */
    private function checkIfRunnerTerminatedRace(): ?JsonResponse
    {
        if ($this->lastCapture && $this->race->laps === $this->lastCapture->lap && $this->race->checkpoints === $this->lastCapture->checkpoint) {
            return response()->json([
                'status' => false,
                'message' => 'Inscription has terminated race'
            ], 400);
        }
        return null;
    }

    /**
     * @return self|null
     */
    private function getLatestCapture($inscriptionId): ?QrCodeCapture
    {
        return QrCodeCapture::where('inscription_id', $inscriptionId)
            ->orderBy('capture_instant', 'desc')
            ->first();
    }

    /**
     * @return int|null
     */
    private function calculateLapCapture(): ?int
    {
        if ($this->lastCapture && $this->lastCapture->checkpoint !== $this->race->checkpoints) {
            return $this->lastCapture->lap;
        }
        return $this->lastCapture->lap + 1;
    }

    /**
     * @param $captureInstant
     * @return DateTime|null
     */
    private function calculateTime($captureInstant): ?DateTime
    {
        $startTime = $this->lastCapture ? $this->lastCapture->capture_instant : $this->race->start_race;
        $diff = $captureInstant->diff($startTime);

        return (new DateTime())->setTime(0, $diff->i, $diff->s, $diff->f * 1000);
    }
}
