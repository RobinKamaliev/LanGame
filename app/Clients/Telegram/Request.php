<?php

namespace App\Clients\Telegram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Request
{
    private const HTTPS = 'https://';
    private const URL_CLIENT = 'api.telegram.org/bot';
    protected const ENDPOINT = '/endpoint';

    public function getUrl(): string
    {
        return self::HTTPS . self::URL_CLIENT . config('telegram.token') . static::ENDPOINT;
    }

    public static function factory(): static
    {
        return new static();
    }
}
