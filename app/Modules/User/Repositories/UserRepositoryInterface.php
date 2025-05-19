<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Dto\GetUserDto;
use App\Modules\User\Dto\LoginUserDto;
use App\Modules\User\Exceptions\UserNotFoundException;
use App\Modules\User\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function create(CreateUserDto $createUserDto): User;

    /**
     * @throws UserNotFoundException
     */
    public function login(LoginUserDto $loginUserDto): User;

    public function getUsers(GetUserDto $getUserDto): Collection;

    public function getUsersByIsConfirmed(bool $isConfirmed, int $paginate): Collection;
}
