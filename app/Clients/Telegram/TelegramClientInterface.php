<?php

namespace App\Clients\Telegram;

interface TelegramClientInterface
{
    public function sendMessage(string $chatId, string $message): bool;
}
