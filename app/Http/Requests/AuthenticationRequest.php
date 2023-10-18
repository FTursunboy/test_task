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


    public function messages()
    {
        return [
            'first_name.required' => 'Имя обязательно для заполнения',
            'first_name.min' => 'Имя должно содержать не менее :min символов',
            'first_name.max' => 'Имя не должно превышать :max символов',

            'last_name.required' => 'Фамилия обязательна для заполнения',
            'last_name.min' => 'Фамилия должна содержать не менее :min символов',
            'last_name.max' => 'Фамилия не должна превышать :max символов',

            'patronymic.min' => 'Отчество должно содержать не менее :min символов',
            'patronymic.max' => 'Отчество не должно превышать :max символов',

            'gender.required' => 'Укажите пол (boolean)',

            'avatar_img.file' => 'Аватар должен быть файлом',

            'login.required' => 'Логин обязателен для заполнения',
            'login.min' => 'Логин должен содержать не менее :min символов',
            'login.max' => 'Логин не должен превышать :max символов',
            'login.unique' => 'Этот логин уже занят',

            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать не менее :min символов',

            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Email должен быть действительным адресом электронной почты',
            'email.unique' => 'Этот email уже зарегистрирован',

            'birth_date.required' => 'Дата рождения обязательна для заполнения',
        ];
    }

}
