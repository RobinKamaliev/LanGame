<?php

declare(strict_types=1);

namespace App\Modules\News\Providers;


use App\Modules\News\Repositories\EloquentNewsRepository;
use App\Modules\News\Repositories\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class NewsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(NewsRepositoryInterface::class, EloquentNewsRepository::class);
    }
}
