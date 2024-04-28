<?php

namespace App\Providers;

use App\Repositories\DepartmentRepository;
use App\Repositories\Interface\DepartmentRepositoryInterface;
use App\Repositories\Interface\RegisterSubjectRepositoryInterface;
use App\Repositories\Interface\ResultRepositoryInterface;
use App\Repositories\Interface\StudentRepositoryInterface;
use App\Repositories\Interface\SubjectRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\RegisterSubjectRepository;
use App\Repositories\ResultRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(StudentRepositoryInterface::class,StudentRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class,SubjectRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class,DepartmentRepository::class);
        $this->app->bind(ResultRepositoryInterface::class,ResultRepository::class);
        $this->app->bind(RegisterSubjectRepositoryInterface::class,RegisterSubjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
