<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interface\ITask;
use App\Repositories\Implementation\TaskRepository;
use App\Repositories\Implementation\UserRepository;
use App\Repositories\Interface\IUser;
use App\Services\Interface\IAuthService;
use App\Services\Interface\ITaskService;
use App\Services\AuthService;
use App\Services\TaskService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any Application services.
     */
    public function register(): void
    {
        $this->app->bind(ITask::class, TaskRepository::class);
        $this->app->bind(IUser::class,UserRepository::class);
        $this->app->bind(IAuthService::class,AuthService::class);
        $this->app->bind(ITaskService::class,TaskService::class);
    

    }

    /**
     * Bootstrap any Application services.
     */
    public function boot()
    {
        //
    }
}
