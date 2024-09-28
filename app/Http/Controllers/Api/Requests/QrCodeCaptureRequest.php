<?php

namespace App\Http\Controllers\Api\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class QrCodeCaptureRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     * @return JsonResponse
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422));
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'race_id' => 'required|exists:races,id',
            'inscription_id' => 'required|exists:inscriptions,id',
            'checkpoint' => 'required',
            'capture_instant' => 'required|date_format:Y-m-d H:i:s.u',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'race_id.required' => 'The race ID is required.',
            'race_id.exists' => 'The selected race does not exist.',
            'inscription_id.required' => 'The inscription ID is required.',
            'inscription_id.exists' => 'The selected inscription does not exist.',
            'checkpoint.required' => 'The checkpoint is required.',
            'capture_instant.required' => 'The capture instant is required.',
            'capture_instant.date_format' => 'The capture instant must be in the format Y-m-d H:i:s.u.',
        ];
    }
}
