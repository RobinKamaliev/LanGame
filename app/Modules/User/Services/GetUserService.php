<?php

declare(strict_types=1);

namespace App\Modules\User\Services;

use App\Modules\User\Dto\GetUserDto;
use App\Modules\User\Dto\PresentUserDto;
use App\Modules\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class GetUserService
{
    private const PAGINATE_USERS = 20;

    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function run(): PresentUserDto
    {
        $usersIsConfirmedTrue = $this->userRepository->getUsersByIsConfirmed(true, self::PAGINATE_USERS);
        $usersIsConfirmedFalse = $this->userRepository->getUsersByIsConfirmed(false, self::PAGINATE_USERS);

        return $this->buildPresentUserDto($usersIsConfirmedTrue, $usersIsConfirmedFalse);
    }

    private function buildPresentUserDto(Collection $usersIsConfirmedTrue, Collection $usersIsConfirmedFalse): PresentUserDto
    {
        return (new PresentUserDto())
            ->setUserIsConfirmedTrue($usersIsConfirmedTrue)
            ->setUserIsConfirmedFalse($usersIsConfirmedFalse);
    }
}
