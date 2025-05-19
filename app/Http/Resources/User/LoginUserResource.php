<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class LoginUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'accessToken' => $this->getAccessToken(),
        ];
    }
}
