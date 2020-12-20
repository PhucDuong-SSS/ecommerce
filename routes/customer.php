<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/',[CustomerController::class, 'showFormLogin'])->name('customer.showFormLogin');
Route::post('/',[CustomerController::class, 'login'])->name('customer.login');
Route::get('/logout',[CustomerController::class, 'logout'])->name('customer.logout');
Route::get('/register',[CustomerController::class, 'showFormRegister'])->name('customer.showFormRegister');
Route::post('/register',[CustomerController::class, 'store'])->name('customer.register');
