<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'offer_id' => 'required|exists:offres,id',
            'status' => 'required|in:new,in_progress,awaiting,completed',
            'number_of_licenses' => 'required|integer|min:1' , // Validate this field as required and an integer
            'description' => 'nullable|string',
            'technology_ids' => 'required|array',
            'technology_ids.*' => 'exists:technologies,id',
        ];
    }

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
