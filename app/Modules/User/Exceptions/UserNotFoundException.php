<?php

declare(strict_types=1);

namespace App\Modules\User\Exceptions;

use App\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;

final class UserNotFoundException extends HttpException
{
    public $message = 'Пользователь не найден.';

    public $code = Response::HTTP_NOT_FOUND;
}
