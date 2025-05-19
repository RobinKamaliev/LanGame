<?php

declare(strict_types=1);

namespace App\Modules\User\Dto;

final class GetUserDto
{
    private int $paginate;

    public function getPaginate(): int
    {
        return $this->paginate;
    }

    public function setPaginate(int $paginate): self
    {
        $this->paginate = $paginate;

        return $this;
    }
}
