<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'siren' => 'sometimes|unique:clients,siren,' . $this->route('id'),
            'siret' => 'sometimes|unique:clients,siret,' . $this->route('id'),
            'legal_name' => 'sometimes|string|max:255',
        ];
    }
}
