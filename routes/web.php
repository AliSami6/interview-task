<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MultipleChoiceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);
    Route::get('/multiple_choice/index', [MultipleChoiceController::class, 'index'])->name('admin/multiple_choice/index');
    Route::get('/multiple_choice/create', [MultipleChoiceController::class, 'create'])->name('admin/multiple_choice/create');
    Route::post('/multiple_choice/save', [MultipleChoiceController::class, 'store'])->name('admin/multiple_choice/save');
    Route::view('multiple_choice/edit/{id}', 'backend.pages.quize.edit');
    Route::get('multiple_choice/edit', [MultipleChoiceController::class, 'edit'])->name('admin/multiple_choice/edit');
    Route::post('/multiple_choice/update', [MultipleChoiceController::class, 'update'])->name('admin/multiple_choice/update');
    Route::delete('/multiple_choice/delete/{id}', [MultipleChoiceController::class, 'destroy'])->name('admin/multiple_choice/delete');
    Route::view('get-quiz/{id}', 'backend.pages.quize.show');
    Route::get('get-quiz', [QuizController::class, 'index'])->name('admin/get-quiz');
    Route::post('save-quiz', [QuizController::class, 'create'])->name('admin/save-quiz');

    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});