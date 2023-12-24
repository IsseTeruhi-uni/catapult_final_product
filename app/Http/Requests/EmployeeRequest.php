<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'picture' => ['file', 'mimes:gif,png,jpg,webp', 'max:3072'],
            'company_id' => ['required'],
            'group_id' => ['required'],
            'post_id' => ['required'],
            'skills' => ['required'],
            'hobbies' => ['required'],
            'description' => ['required', 'max:255']
        ];
    }
}
