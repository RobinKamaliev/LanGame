<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configRateLimiter();

        foreach (glob(base_path('routes/api/v*/*')) as $file) {
            $version = basename(dirname($file));

            Route::middleware('api')
                ->prefix("api/{$version}")
                ->group($file);
        }

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    private function configRateLimiter(): void
    {
        RateLimiter::for('global', static function (Request $request): Limit {
            return Limit::perSecond(10)->by($request->ip());
        });
    }
}
