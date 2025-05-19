<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Modules\User\Dto\ConfirmConfirmationCodeDto;
use Illuminate\Foundation\Http\FormRequest;

final class ConfirmCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|integer|min:6|max:6',
            'user_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'code.string' => 'Пароль должен быть числом.',
            'code.min' => 'Пароль должен содержать минимум 6 символов.',
            'code.max' => 'Пароль должен содержать максимум 6 символов.',
        ];
    }

    public function toDto(): ConfirmConfirmationCodeDto
    {
        return (new ConfirmConfirmationCodeDto())
            ->setCode((int)$this->input('code'))
            ->setUserId((int)$this->input('user_id'));
    }
}
