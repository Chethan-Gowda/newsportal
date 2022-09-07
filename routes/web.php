<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
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

Route::get('/',[HomeController::class, 'index'] )->name('home');
Route::get('/about',[HomeController::class, 'about'] )->name('about');



/* Admin Login Reset */
Route::get('/admin/home',[AdminHomeController::class, 'index'] )->name('adminIndex')->middleware('admin:admin');
Route::get('/admin/login',[AdminLoginController::class, 'login'] )->name('adminLogin');
Route::get('/admin/logout',[AdminLoginController::class, 'adminLogout'] )->name('adminLogout');
Route::post('/admin/login',[AdminLoginController::class, 'adminLoginProcess'] )->name('adminLoginProcess');
Route::get('/admin/forget-password',[AdminLoginController::class, 'forgetPasswordView'] )->name('adminForgetPasswordView');
Route::post('/admin/forget-password',[AdminLoginController::class, 'forgetPasswordSubmit'] )->name('adminForgetPasswordSubmit');
Route::post('/admin/reset-password',[AdminLoginController::class, 'adminResetPasswordSubmit'] )->name('adminResetPasswordSubmit');
Route::get('/admin/reset-password/{token}/{email}',[AdminLoginController::class, 'resetPassword'] )->name('resetPassword');
/* Admin Profile  */
Route::get('/admin/profile',[AdminProfileController::class, 'adminProfile'] )->name('adminProfile')->middleware('admin:admin');
Route::post('/admin/profile/update',[AdminProfileController::class, 'adminProfileEditSubmit'] )->name('adminProfileEditSubmit')->middleware('admin:admin');