<?php

namespace App\Providers;

use App\Clients\Telegram\TelegramApiClient;
use App\Clients\Telegram\TelegramClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TelegramClientInterface::class, TelegramApiClient::class);
    }

    public function boot(): void
    {
        //
    }
}
