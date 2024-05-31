<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\facController;
use App\Http\Controllers\AdminController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('qrLogin', ['uses' => 'App\Http\Controllers\QrLoginController@index']);
Route::post('qrLogin', ['uses' => 'App\Http\Controllers\QrLoginController@checkUser']);


Route::get('/user-details', [facController::class, 'showForm'])->name('welcome.form');
Route::post('/user-details', [facController::class, 'getUserDetails'])->name('welcome.submit');


Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::get('/logins', [HomeController::class, 'showLoginForms'])->name('logins');
Route::post('/logins', [HomeController::class, 'logins']);
Route::post('/logout-student', [HomeController::class, 'logouts'])->name('admin.users');




Route::get('/admin', [AdminController::class, 'index'])->name('admin.admindashboard');

Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');

Route::get('/admin/request', [AdminController::class, 'showUsersPending'])->name('admin.request');
Route::put('/admin/{user}/markAsAccepted', [AdminController::class, 'markAsAccepted'])->name('admin.markAsAccepted');

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

Route::post('/import', [AdminController::class, 'import'])->name('import');
Route::get('registers', [AdminController::class, 'showRegistrationForm'])->name('registers');
Route::post('registers', [AdminController::class, 'create']);