<?php

declare(strict_types=1);

namespace App\Modules\User\Repositories;

use App\Modules\User\Dto\ConfirmConfirmationCodeDto;
use App\Modules\User\Dto\CreateConfirmationCodeDto;
use App\Modules\User\Models\ConfirmationCode;
use Carbon\Carbon;

final class EloquentConfirmationCodeRepository implements ConfirmationCodeRepositoryInterface
{
    public function updateOrCreate(CreateConfirmationCodeDto $createConfirmationCodeDto): void
    {
        ConfirmationCode::query()
            ->updateOrCreate(
                ['user_id' => $createConfirmationCodeDto->getUserId()],
                [
                    'is_used' => $createConfirmationCodeDto->isUsed(),
                    'code' => $createConfirmationCodeDto->getCode(),
                    'sent_at' => Carbon::now(),
                ]
            );
    }

    public function getCodeByUserId(int $userId): int
    {
        return ConfirmationCode::query()
            ->where(['user_id' => $userId])
            ->value('code');
    }

    public function confirmationCode(ConfirmConfirmationCodeDto $confirmationCodeDto): void
    {
        ConfirmationCode::query()
            ->where(['user_id' => $confirmationCodeDto->getUserId()])
            ->update([
                'is_used' => true,
            ]);
    }
}
