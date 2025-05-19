<?php

declare(strict_types=1);

namespace App\Modules\User\Services\Auth;

use App\Jobs\SendConfirmationCodeJob;
use App\Modules\User\Dto\CreateConfirmationCodeDto;
use App\Modules\User\Dto\CreateUserDto;
use App\Modules\User\Events\UserRegisteredBroadcast;
use App\Modules\User\Models\User;
use App\Modules\User\Repositories\ConfirmationCodeRepositoryInterface;
use App\Modules\User\Repositories\UserRepositoryInterface;

final readonly class CreateUserService
{
    public function __construct(
        private UserRepositoryInterface             $userRepository,
        private ConfirmationCodeRepositoryInterface $codeRepository
    )
    {
    }

    public function run(CreateUserDto $createUserDto): User
    {
        $user = $this->userRepository->create($createUserDto);

        $this->codeRepository->updateOrCreate(
            (new CreateConfirmationCodeDto())
                ->setUserId($user->id)
                ->setIsUsed(false)
                ->setCode($code = random_int(100000, 999999))
        );

        event(new UserRegisteredBroadcast());

        $chatId = config('telegram.chat_id');
        SendConfirmationCodeJob::dispatch($chatId, $code);

        return $user;
    }
}
