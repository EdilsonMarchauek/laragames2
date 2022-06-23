<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    //Reports
    Route::get('reports/years', [ReportsController::class, 'year'])->name('reports.year');
    Route::get('reports/months', [ReportsController::class, 'months2'])->name('reports.months');
 
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);

    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('products', ProductController::class);
    
    Route::any('products/fotodestroylast/{id}', [ProductController::class, 'fotodestroylast'])->name('products.fotodestroylast');
    Route::any('products/fotodestroyall/{id}', [ProductController::class, 'fotodestroyall'])->name('products.fotodestroyall');
    Route::any('products/capadestroy/{id}', [ProductController::class, 'capadestroy'])->name('products.capadestroy');
  
    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('categories', CategoryController::class);

    //Para criar o controller informar conforme abaixo
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
});

Auth::routes(['register' => false]);

Route::get('/index', [SiteController::class, 'index']);
Route::any('/search', [SiteController::class, 'search'])->name('site.search');
Route::resource('site', SiteController::class);
Route::get('/inicio', [SiteController::class, 'index'])->name('site.inicio');
Route::get('/quemsomos', [SiteController::class, 'quemsomos'])->name('site.quemsomos');
Route::get('/faleconosco', [SiteController::class, 'faleconosco'])->name('site.faleconosco');

//PHP Mailer
Route::get("email", [MailerController::class, "email"])->name("email");
Route::post("send-email", [MailerController::class, "composeEmail"])->name("send-email");
Route::get("orcamento/{id}", [MailerController::class, "orcamento"])->name("orcamento");
Route::post("send-orcamento", [MailerController::class, "composeOrcamento"])->name("send-orcamento");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/teste', function () {
    return storage_path();
 });

 Route::get('/link', function () {
    $target = '/var/www/html/divulguenaweb.com.br/web/lara/storage/app/public';
    $shorcut = '/var/www/html/divulguenaweb.com.br/web/storage';
    symlink($target, $shorcut);
 });

 Route::get('/clear', function() {

    Artisan::call('cache:clear');
    
    dd("Cache Clear All");

});



