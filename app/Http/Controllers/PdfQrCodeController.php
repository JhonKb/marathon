<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfQrCodeController extends Controller
{
     public function downloadPdf($id)
    {
        $record = Inscription::find($id);

        $qrCode = base64_encode(QrCode::format('png')->size(700)->generate(json_encode([ 'id' => $record->id, 'race-id' => $record->race->id, 'name' => $record->name])));

        $pdf = Pdf::loadView('qr-code.pdf-view', ['qrCode' => $qrCode]);

        $pdf->setPaper('A4');

        return $pdf->download($record->name . '.pdf');
    }
}
