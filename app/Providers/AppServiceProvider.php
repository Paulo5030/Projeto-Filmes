<?php

namespace App\Providers;

use App\Models\Message;
use App\Services\AuthService;
use App\Services\Contracts\AuthInterface;
use App\Services\Contracts\MovieStarInterface;
use App\Services\Contracts\ReviewInterface;
use App\Services\MovieStarService;
use App\Services\ReviewService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(Message::class, function () {
            return new Message('Por favor, preencha todos os campos.');
        });

        $this->app->bind(AuthInterface::class, AuthService::class);
        $this->app->bind(MovieStarInterface::class, MovieStarService::class);
        $this->app->bind(ReviewInterface::class, ReviewService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
