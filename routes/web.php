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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;

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

//Frontend
Route::get('/',[ProductController::class, 'showProductFrontend'])->name('index');
//Contact page
Route::get('show-contact-page',[ContactController::class, 'showContactPage'])->name('contact.showContactPage');
Route::post('show-contact-page',[ContactController::class, 'storeInfo'])->name('contact.storeInfo');

// Show detail products
Route::get('show-product-details/{id}',[ProductController::class, 'showDetails'])->name('product.showDetails');
Route::get('show-product-category/{id}',[ProductController::class, 'showProductCategory'])->name('product.showProductCategory');

//recently product
Route::post('show-recently-product',[ProductController::class, 'renderProductView'])->name('product.showrecently');


//Add cart
Route::get('add-cart/{id}',[CartController::class, 'addCart'])->name('cart.addCart');
Route::post('add-product-cart/{id}',[CartController::class, 'addProductCart'])->name('cart.addProductCart');
Route::get('customer/add-wishlist/{id}',[WishlistController::class, 'addWishlist'])->name('wishlist.addWishlist');
//Show cart
Route::get('show-cart',[CartController::class, 'showCart'])->name('cart.showCart');
Route::get('remove-cart/{id}',[CartController::class, 'removeCart'])->name('cart.removeCart');
Route::get('remove-all-cart',[CartController::class, 'destroyCart'])->name('cart.destroyCart');
Route::post('update-cart',[CartController::class, 'updateCart'])->name('cart.updateCart');
Route::get('customer/checkout',[CartController::class, 'checkout'])->name('cart.checkout');
Route::get('customer/checkout',[CartController::class, 'checkout'])->name('cart.checkout');
Route::post('customer/add-coupon',[CartController::class, 'coupon'])->name('cart.addCoupon');
Route::get('customer/remove-coupon',[CartController::class, 'couponRemove'])->name('cart.couponRemove');
Route::get('customer/payment',[CartController::class, 'showPaymentPage'])->name('cart.showPaymentPage');
Route::post('customer/payment-process',[PaymentController::class, 'paymentProcess'])->name('payment.paymentProcess');
Route::post('customer/payment-process',[PaymentController::class, 'paymentProcess'])->name('payment.paymentProcess');
Route::post('customer/stripe-charge',[PaymentController::class, 'stripeCharge'])->name('payment.stripeCharge');


//Admin
Route::get('admin/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'showHome'])->name('dashboard.show');
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
        Route::post('update-photo/{id}',[ProductController::class, 'updateImage'])->name('product.updatephoto');
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

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'showOrder'])->name('order.showOrder');
            Route::get('view/{id}', [OrderController::class, 'viewOrder'])->name('order.viewOrder');
            Route::get('accept-payment/{id}', [OrderController::class, 'acceptPayment'])->name('order.acceptPayment');
            Route::get('cancel-payment/{id}', [OrderController::class, 'cancelPayment'])->name('order.cancelPayment');
            Route::get('delivery-process/{id}', [OrderController::class, 'deleveryProcess'])->name('order.deleveryProcess');
            Route::get('delivery-done/{id}', [OrderController::class, 'doneDelivery'])->name('order.doneDelivery');
            Route::get('accept-payment-show', [OrderController::class, 'showAcceptPayment'])->name('order.showAcceptPayment');
            Route::get('cancel-order-show', [OrderController::class, 'showCancelOrder'])->name('order.showCancelOrder');
            Route::get('process-payment-show', [OrderController::class, 'showProcessPayment'])->name('order.showProcessPayment');
            Route::get('success-order-show', [OrderController::class, 'showSuccessPayment'])->name('order.showSuccessPayment');
        });
        //Report order
        Route::prefix('report')->group(function () {
            Route::get('today-order', [ReportController::class, 'getTodayOrder'])->name('report.getTodayOrder');
            Route::get('today-delivery', [ReportController::class, 'getTodayDelivery'])->name('report.getTodayDelivery');
            Route::get('thismonth-delivery', [ReportController::class, 'getThisMonthDelivery'])->name('report.getThisMonthDelivery');
            Route::get('search-report', [ReportController::class, 'searchReport'])->name('report.searchReport');
            Route::post('search-by-date', [ReportController::class, 'searchByDate'])->name('report.searchByDate');
            Route::post('search-by-month', [ReportController::class, 'searchByMonth'])->name('report.searchByMonth');
            Route::post('search-by-year', [ReportController::class, 'searchByYear'])->name('report.searchByYear');
        });
        //role
        Route::prefix('role')->group(function () {
            Route::get('show-user', [AdminController::class, 'showUser'])->name('admin.showUser');
            Route::get('create-user', [AdminController::class, 'createUser'])->name('admin.createUser');
            Route::post('store-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');
            Route::post('edit-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
            Route::get('show-edit-user/{id}', [AdminController::class, 'showFormEdit'])->name('admin.showFormEdit');
            Route::get('delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        });

        Route::prefix('stock')->group(function () {
            Route::get('show-user', [ProductController::class, 'getProductStock'])->name('product.getProductStock');

        });
        Route::prefix('contact')->group(function () {
            Route::get('get-mesage',[ContactController::class, 'getMessage'])->name('contact.getMessage');
            Route::get('get-mesage-details/{id}',[ContactController::class, 'showDetail'])->name('contact.showDetail');

        });


    });




});
