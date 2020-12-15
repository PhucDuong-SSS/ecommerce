<?php

namespace App\Providers;




use App\Http\Repo\CategoryRepo\CategoryRepository;
use App\Http\Repo\CategoryRepo\CategoryRepositoryInterface;
use App\Http\Repo\SubCategoryRepo\SubCategoryRepository;
use App\Http\Repo\SubCategoryRepo\SubCategoryRepositoryInterface;
use App\Http\Repo\UserRepo\UserRepository;
use App\Http\Repo\UserRepo\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
