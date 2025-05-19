<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class GetUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'userId' => $this->id,
            'email' => $this->email,
            'lastName' => $this->last_name,
            'firstName' => $this->first_name,
        ];
    }
}
