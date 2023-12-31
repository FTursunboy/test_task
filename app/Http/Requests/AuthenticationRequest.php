<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticationRequest extends FormRequest
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
            'avatar_img' => 'nullable|file',
            'login' => 'required|min:3|max:15|unique:users,login',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'required',
        ];
    }




}
