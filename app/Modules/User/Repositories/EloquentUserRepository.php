<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Dto\GetUserDto;
use App\Modules\User\Dto\LoginUserDto;
use App\Modules\User\Exceptions\UserNotFoundException;
use App\Modules\User\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(CreateUserDto $createUserDto): User
    {
        return User::query()->create([
            'first_name' => $createUserDto->getFirstName(),
            'last_name' => $createUserDto->getLastName(),
            'email' => $createUserDto->getEmail(),
            'password' => Hash::make($createUserDto->getPassword()),
        ]);
    }

    /**
     * @throws UserNotFoundException
     */
    public function login(LoginUserDto $loginUserDto): User
    {
        $user = User::query()
            ->where(
                'email',
                $loginUserDto->getEmail()
            )
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function getUsers(GetUserDto $getUserDto): Collection
    {
        return User::query()
            ->paginate($getUserDto->getPaginate())
            ->getCollection();
    }

    public function getUsersByIsConfirmed(bool $isConfirmed, int $paginate): Collection
    {
        return User::query()
            ->where('is_confirmed', $isConfirmed)
            ->paginate($paginate)
            ->collect();
    }
}
