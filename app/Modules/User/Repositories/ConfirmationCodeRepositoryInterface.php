<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Modules\User\Dto\ConfirmConfirmationCodeDto;
use App\Modules\User\Dto\CreateConfirmationCodeDto;

interface ConfirmationCodeRepositoryInterface
{
    public function updateOrCreate(CreateConfirmationCodeDto $createConfirmationCodeDto): void;
    public function getCodeByUserId(int $userId): int;
    public function confirmationCode(ConfirmConfirmationCodeDto $confirmationCodeDto): void;
}
