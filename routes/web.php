<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Auth\AuthController;
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

Route::get('/', [App\Http\Controllers\MainController::class, 'welcome'])->name('welcome');
Route::get('product/{id}/details', [App\Http\Controllers\Blade\ProductController::class, 'details'])->name('product.details');
Route::get('contact', [App\Http\Controllers\MainController::class, 'contact'])->name('contact');
Route::get('shop', [App\Http\Controllers\MainController::class, 'shop'])->name('shop');
Route::post('shop', [App\Http\Controllers\MainController::class, 'shopPost'])->name('shop.post');
Route::get('shop/{id}/catalog', [App\Http\Controllers\MainController::class, 'shopCatalog'])->name('shop.catalog');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();

Route::group(['middleware' => ['guest'],'prefix'=>'admin'], function() {
    Route::get('login',[AuthController::class,'loginIndex'])->name('login');
    Route::post('auth/login',[AuthController::class,'login2'])->name('login2');
    Route::get('auth/forget', [AuthController::class,'forget'])->name('auth.forget');
    Route::post('auth/forget',[AuthController::class,'forgetPost'])->name('auth.forget.post');
    Route::get('auth/forget/check', [AuthController::class,'forgetCheck'])->name('auth.forget.check');
    Route::post('auth/forget/check', [AuthController::class,'forgetCheckPost'])->name('auth.forget.check.post');
    Route::get('auth/set/password', [AuthController::class,'setPassword'])->name('auth.set.password');
    Route::post('auth/set/password', [AuthController::class,'setPasswordPost'])->name('auth.set.password.post');
});
Route::group(['namespace' => 'App\Http\Controllers','prefix'=>'admin'], function()
{
    Route::group(['middleware' => ['auth', 'permission']], function() {
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});

Route::group(['middleware' => 'auth','prefix'=>'admin'], function () {
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile',[App\Http\Controllers\UserController::class,'profileShow'])->name('profile.edit');
    Route::post('profile/password',[App\Http\Controllers\UserController::class,'profilePassword'])->name('profile.password');
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
     Route::resource('catalog', 'App\Http\Controllers\Blade\CatalogController');
     Route::resource('brand', 'App\Http\Controllers\Blade\BrandController');
     Route::resource('carousel', 'App\Http\Controllers\Blade\CarouselController');
     Route::resource('product', 'App\Http\Controllers\Blade\ProductController');

     Route::post('profile/update', [App\Http\Controllers\ProfileController::class,'update'])->name('profile.update');
    Route::post('product/index',[App\Http\Controllers\Blade\ProductController::class,'indexApi']);
});

// Change language session condition
Route::get('/language/{lang}', function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});
