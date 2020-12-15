<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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
    return view('admin.layout.login');
});

Route::get('login', [LoginController::class, 'showLogin'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->group(function (){
    Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard.show');
    Route::get('change-password', [AdminController::class, 'showChangePassword'])->name('admin.changepassword');
    Route::post('change-password', [AdminController::class, 'updatePassword'])->name('admin.updatepassword');

    Route::prefix('category')->group(function (){
        Route::get('/',[CategoryController::class,'index'])->name('category.list');
        Route::post('/',[CategoryController::class,'store'])->name('category.store');
        Route::get('edit/{id}',[CategoryController::class,'showFormEdit'])->name('category.editForm');
        Route::post('edit/{id}',[CategoryController::class,'update'])->name('category.update');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    });
    Route::prefix('sub-category')->group(function (){
        Route::get('/',[SubCategoryController::class,'index'])->name('subcategory.list');
        Route::post('/',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('edit/{id}',[SubCategoryController::class,'showFormEdit'])->name('subcategory.editForm');
        Route::post('edit/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::get('delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');

    });
});
