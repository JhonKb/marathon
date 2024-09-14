<?php

use App\Http\Controllers\PdfQrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-pdf/{id}', [PdfQrCodeController::class, 'downloadPdf'])->name('download.pdf');
