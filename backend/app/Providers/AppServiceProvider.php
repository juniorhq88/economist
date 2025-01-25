<?php

namespace App\Providers;

use App\Interfaces\FormFieldRepositoryInterface;
use App\Interfaces\FormRepositoryInterface;
use App\Interfaces\MessageRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\FormFieldRepository;
use App\Repositories\FormRepository;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            FormRepositoryInterface::class,
            FormRepository::class
        );

        $this->app->bind(
            FormFieldRepositoryInterface::class,
            FormFieldRepository::class
        );

        $this->app->bind(
            MessageRepositoryInterface::class,
            MessageRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
