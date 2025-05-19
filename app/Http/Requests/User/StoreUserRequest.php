<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Modules\User\Dto\CreateUserDto;
use Illuminate\Foundation\Http\FormRequest;

final class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'query' => 'required|string',
        ];
    }

    public function toDto(): CreateUserDto
    {
        return (new CreateUserDto())
            ->setFirstName($this->input('firstName'))
            ->setLastName($this->input('lastName'))
            ->setEmail($this->input('email'))
            ->setPassword($this->input('password'));
    }
}
