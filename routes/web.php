<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\NewsLaterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return bcrypt('123456');
//    return  view('admin.category.list');
    return view('page.layout.index');
//    return view('page.blog');
});
//Frontend
Route::get('/',[ProductController::class, 'showProductFrontend'])->name('index');
//Add cart
Route::get('add-cart/{id}',[CartController::class, 'addCart'])->name('cart.addCart');
//Show cart
Route::get('show-cart',[CartController::class, 'showCart'])->name('cart.showCart');
Route::get('remove-cart/{id}',[CartController::class, 'removeCart'])->name('cart.removeCart');
Route::get('remove-all-cart',[CartController::class, 'destroyCart'])->name('cart.destroyCart');
Route::post('update-cart',[CartController::class, 'updateCart'])->name('cart.updateCart');



//Admin
Route::get('admin/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard.show');
    Route::get('change-password', [AdminController::class, 'showChangePassword'])->name('admin.changepassword');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('admin.updatepassword');

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.list');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'showFormEdit'])->name('category.editForm');
        Route::post('edit/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::prefix('sub-category')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('subcategory.list');
        Route::post('/', [SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('edit/{id}', [SubCategoryController::class, 'showFormEdit'])->name('subcategory.editForm');
        Route::post('edit/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
        Route::get('delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');

    });
    Route::prefix('brand')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.list');
        Route::post('/', [BrandController::class, 'store'])->name('brand.store');
        Route::get('edit/{id}', [BrandController::class, 'showFormEdit'])->name('brand.editForm');
        Route::post('edit/{id}', [BrandController::class, 'update'])->name('brand.update');
        Route::get('delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
    });

    Route::prefix('coupon')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('coupon.list');
        Route::post('/', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('edit/{id}', [CouponController::class, 'showFormEdit'])->name('coupon.editForm');
        Route::post('edit/{id}', [CouponController::class, 'update'])->name('coupon.update');
        Route::get('delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');
    });
    Route::prefix('newlater')->group(function () {
        Route::get('/', [NewsLaterController::class, 'index'])->name('newslater.list');
        Route::get('delete/{id}', [NewsLaterController::class, 'delete'])->name('newslater.delete');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.list');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('create', [ProductController::class, 'showCreateForm'])->name('product.createForm');
        Route::get('edit/{id}', [ProductController::class, 'showFormEdit'])->name('product.editForm');
        Route::post('edit-product/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::get('get-subcategory/{id}', [ProductController::class, 'getSubCategory'])->name('product.getsubcategory');
        Route::post('update-photo/{id}', [ProductController::class, 'updateImageProduct'])->name('product.updatephoto');
        Route::get('inactive/{id}', [ProductController::class, 'inactive'])->name('product.inactive');
        Route::get('active/{id}', [ProductController::class, 'active'])->name('product.active');

        Route::prefix('post-category')->group(function () {
            Route::get('/', [PostCategoryController::class, 'index'])->name('postcategory.list');
            Route::post('/', [PostCategoryController::class, 'store'])->name('postcategory.store');
            Route::get('edit/{id}', [PostCategoryController::class, 'showFormEdit'])->name('postcategory.editForm');
            Route::post('edit/{id}', [PostCategoryController::class, 'update'])->name('postcategory.update');
            Route::get('delete/{id}', [PostCategoryController::class, 'delete'])->name('postcategory.delete');

    });
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('post.list');
            Route::post('/', [PostController::class, 'store'])->name('post.store');
            Route::get('create', [PostController::class, 'showFormCreate'])->name('post.createForm');
            Route::get('edit/{id}', [PostController::class, 'showFormEdit'])->name('post.editForm');
            Route::post('edit/{id}', [PostController::class, 'update'])->name('post.update');
            Route::get('delete/{id}', [PostController::class, 'delete'])->name('post.delete');
        });

        Route::prefix('site-setting')->group(function () {
            Route::get('/', [SiteSettingController::class, 'index'])->name('siteSetting.list');
            Route::post('edit/{id}', [SiteSettingController::class, 'update'])->name('siteSetting.update');
        });


    });




});
