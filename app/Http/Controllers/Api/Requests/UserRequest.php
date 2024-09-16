<?php

namespace App\Http\Controllers\Api\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Authorizes data validation
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Returns validation failure response
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator): mixed
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422));
    }

    /**
     * Defines user validation rules
     * @return string[]
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email' . ($userId ? $userId->id : null),
            'password' => 'required|min:6'
        ];
    }

    /**
     * Users validation messages
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least :min characters.',
        ];
    }
}
