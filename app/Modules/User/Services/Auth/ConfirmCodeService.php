<?php

declare(strict_types=1);

namespace App\Modules\User\Services\Auth;

use App\Modules\User\Dto\ConfirmConfirmationCodeDto;
use App\Modules\User\Exceptions\ErrorConfirmCodeException;
use App\Modules\User\Repositories\ConfirmationCodeRepositoryInterface;

final readonly class ConfirmCodeService
{
    public function __construct(
        private ConfirmationCodeRepositoryInterface $confirmationCodeRepository
    )
    {
    }

    /**
     * @throws ErrorConfirmCodeException
     */
    public function run(ConfirmConfirmationCodeDto $confirmationCodeDto): void
    {
        $code = $this->confirmationCodeRepository->getCodeByUserId($confirmationCodeDto->getUserId());

        if ($code !== $confirmationCodeDto->getCode()) {
            throw new ErrorConfirmCodeException();
        }

        $this->confirmationCodeRepository->confirmationCode($confirmationCodeDto);
    }
}
