<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Modules\User\Dto\LoginUserDto;
use Illuminate\Foundation\Http\FormRequest;

final class LoginUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
        ];
    }

    public function toDto(): LoginUserDto
    {
        return (new LoginUserDto())
            ->setEmail($this->input('email'))
            ->setPassword($this->input('password'));
    }
}
