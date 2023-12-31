<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:15',
            'last_name' => 'required|min:3|max:15',
            'patronymic' => 'nullable|string|min:3|max:15',
            'gender' => 'required|boolean',
            'avatar_img' => 'file|nullable',
            'login' => 'required|min:3|max:15|unique:users,login,' . $this->user->id,
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'birth_date' => 'required|date',
        ];
    }

    public function messages()
    {
        return parent::messages();
    }
}
