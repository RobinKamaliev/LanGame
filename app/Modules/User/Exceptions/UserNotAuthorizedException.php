<?php

declare(strict_types=1);

namespace App\Modules\User\Exceptions;

use App\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;

final class UserNotAuthorizedException extends HttpException
{
    public $message = 'Пользователь не авторизован.';

    public $code = Response::HTTP_BAD_REQUEST;
}
