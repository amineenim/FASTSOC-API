<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:new,in_progress,awaiting,completed',
            'number_of_licenses' => 'sometimes|integer|min:1',
            'description' => 'nullable|string',
            'technology_ids' => 'sometimes|array',
            'technology_ids.*' => 'exists:technologies,id',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed for the update request.',
            ], 422)
        );
    }
}
