<?php

declare(strict_types=1);

namespace App\Modules\User\Exceptions;

use App\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;

final class IncorrectLoginOrPasswordException extends HttpException
{
    public $message = 'Не верный логин или пароль.';

    public $code = Response::HTTP_BAD_REQUEST;
}
