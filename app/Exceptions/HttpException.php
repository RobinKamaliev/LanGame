<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class HttpException extends Exception
{
    public $code;
    public $message;

    public function render(): JsonResponse
    {
        $response = [
            'error' => $this->message,
            'exception' => static::class
        ];

        if (config('app.debug')) {
            $response['debug'] = [
                'message' => $this->getMessage(),
                'file' => $this->getFile(),
                'line' => $this->getLine(),
                'trace' => collect($this->getTrace())->take(10),
            ];
        }

        return response()->json($response, $this->code);
    }
}
