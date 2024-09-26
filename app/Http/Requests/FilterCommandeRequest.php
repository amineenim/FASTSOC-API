<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterCommandeRequest extends FormRequest
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
            'offer_id' => 'sometimes|exists:offres,id',
            'technology_id' => 'sometimes|exists:technologies,id',
            'client_id' => 'sometimes|exists:clients,id',
            'status' => 'sometimes|in:new,in_progress,awaiting,completed',
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
                'message' => 'Invalid parameters provided.',
            ], 422)
        );
    }
}
