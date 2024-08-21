<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nrp' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:255',
            'status' => 'nullable',
            'grade' => 'nullable|numeric',
            'promotion_date' => 'nullable|date',
            'position_id' => 'nullable',
            'department_id' => 'nullable',
            'site_id' => 'nullable',
            'education' => 'nullable',
            'total_point' => 'nullable',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
            'role' => 'required|string'
        ];
    }
}
