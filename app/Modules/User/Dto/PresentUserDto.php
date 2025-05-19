<?php

declare(strict_types=1);

namespace App\Modules\User\Dto;

use Illuminate\Support\Collection;

final class PresentUserDto
{
    private Collection $userIsConfirmedTrue;
    private Collection $userIsConfirmedFalse;

    public function getUserIsConfirmedTrue(): Collection
    {
        return $this->userIsConfirmedTrue;
    }

    public function setUserIsConfirmedTrue(Collection $userIsConfirmedTrue): self
    {
        $this->userIsConfirmedTrue = $userIsConfirmedTrue;
        return $this;
    }

    public function getUserIsConfirmedFalse(): Collection
    {
        return $this->userIsConfirmedFalse;
    }

    public function setUserIsConfirmedFalse(Collection $userIsConfirmedFalse): self
    {
        $this->userIsConfirmedFalse = $userIsConfirmedFalse;
        return $this;
    }


}
