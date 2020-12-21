<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/',[CustomerController::class, 'showFormLogin'])->name('customer.showFormLogin');
Route::post('/',[CustomerController::class, 'login'])->name('customer.login');
Route::get('logout',[CustomerController::class, 'logout'])->name('customer.logout');
Route::get('register',[CustomerController::class, 'showFormRegister'])->name('customer.showFormRegister');
Route::post('register',[CustomerController::class, 'store'])->name('customer.register');
Route::get('profile',[CustomerController::class, 'showProfile'])->name('customer.showProfile');
Route::get('change-password',[CustomerController::class, 'showFormChangePassword'])->name('customer.showFormChangePassword');
Route::post('update-password',[CustomerController::class, 'updatePassword'])->name('customer.updatePassword');
