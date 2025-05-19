<?php

namespace App\Jobs;

use App\Clients\Telegram\TelegramClientInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendConfirmationCodeJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly TelegramClientInterface $telegramClient,
        private readonly string $chatId,
        private readonly int|string $code,
    ) {}

    public function handle(): void
    {
        $this->telegramClient->sendMessage($this->chatId, $this->code);
    }
}
