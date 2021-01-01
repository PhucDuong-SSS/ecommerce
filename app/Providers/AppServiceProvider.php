<?php

namespace App\Providers;




use App\Http\Repo\BrandRepo\BrandRepository;
use App\Http\Repo\BrandRepo\BrandRepositoryInterface;
use App\Http\Repo\CategoryRepo\CategoryRepository;
use App\Http\Repo\CategoryRepo\CategoryRepositoryInterface;
use App\Http\Repo\ContactRepo\ContactRepository;
use App\Http\Repo\ContactRepo\ContactRepositoryInterface;
use App\Http\Repo\CouponRepo\CouponRepository;
use App\Http\Repo\CouponRepo\CouponRepositoryInterface;
use App\Http\Repo\CustomerRepo\CustomerRepository;
use App\Http\Repo\CustomerRepo\CustomerRepositoryInterface;
use App\Http\Repo\NewsLaterRepo\NewsLaterRepository;
use App\Http\Repo\NewsLaterRepo\NewsLaterRepositoryInterface;
use App\Http\Repo\OrderRepo\OrderRepository;
use App\Http\Repo\OrderRepo\OrderRepositoryInterface;
use App\Http\Repo\PostCategoryRepo\PostCategoryRepository;
use App\Http\Repo\PostCategoryRepo\PostCategoryRepositoryInterface;
use App\Http\Repo\PostRepo\PostRepository;
use App\Http\Repo\PostRepo\PostRepositoryInterface;
use App\Http\Repo\ProductRepo\ProductRepository;
use App\Http\Repo\ProductRepo\ProductRepositoryInterface;
use App\Http\Repo\SiteSettingRepo\SiteSettingRepository;
use App\Http\Repo\SiteSettingRepo\SiteSettingRepositoryInterface;
use App\Http\Repo\SubCategoryRepo\SubCategoryRepository;
use App\Http\Repo\SubCategoryRepo\SubCategoryRepositoryInterface;
use App\Http\Repo\UserRepo\UserRepository;
use App\Http\Repo\UserRepo\UserRepositoryInterface;
use App\Http\Repo\WishlistRepo\WishlistRepository;
use App\Http\Repo\WishlistRepo\WishlistRepositoryInterface;
use Illuminate\Support\Facades\URL;
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
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(NewsLaterRepositoryInterface::class, NewsLaterRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(PostCategoryRepositoryInterface::class, PostCategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(SiteSettingRepositoryInterface::class, SiteSettingRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        URL::forceScheme('https');
    }
}
