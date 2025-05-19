<?php

namespace App\Modules\User\Dto;

final class ConfirmConfirmationCodeDto
{
    private int $code;
    private int $userId;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
}
