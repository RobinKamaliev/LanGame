<?php

declare(strict_types=1);

namespace App\Modules\User\Providers;

use App\Modules\User\Repositories\ConfirmationCodeRepositoryInterface;
use App\Modules\User\Repositories\EloquentConfirmationCodeRepository;
use App\Modules\User\Repositories\EloquentUserRepository;
use App\Modules\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(ConfirmationCodeRepositoryInterface::class, EloquentConfirmationCodeRepository::class);
    }
}
