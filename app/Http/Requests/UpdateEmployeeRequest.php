<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|required|string|max:100',
            'last_name'  => 'sometimes|required|string|max:100',
            'email'      => 'sometimes|required|email',
            'department_id' => 'sometimes|required|string',
            'contacts' => 'nullable|array',
            'contacts.*' => 'required|string|max:15',
            'addresses' => 'nullable|array',
            'addresses.*.address_line' => 'required_with:addresses|string',
            'addresses.*.city' => 'required_with:addresses|string|max:50',
            'addresses.*.state' => 'required_with:addresses|string|max:60',
            'addresses.*.pincode' => 'required_with:addresses|string|max:10',
        ];
    }
}
