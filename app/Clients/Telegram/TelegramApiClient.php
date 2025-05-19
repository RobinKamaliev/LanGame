<?php

declare(strict_types=1);

namespace App\Clients\Telegram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramApiClient implements TelegramClientInterface
{
    public function sendMessage(string $chatId, string $message): bool
    {
        $payload = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        try {
            $response = Http::post(
                SendMessageRequest::factory()->getUrl(),
                $payload
            );

            return $response->successful();
        } catch (\Throwable $e) {
            Log::error('Telegram sendMessage error', [
                'error' => $e->getMessage(),
                'payload' => $payload,
            ]);

            return false;
        }
    }
}
