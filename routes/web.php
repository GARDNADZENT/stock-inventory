<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockTakeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('privacy-policy', [PublicController::class, 'privacyPolicy'])->name('privacy-policy');

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'store'])->middleware('throttle:6,1')->name('login.store');

Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('register/sent', [RegisterController::class, 'sent'])->name('register.sent');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.forgot');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('forgot-password/sent', [ForgotPasswordController::class, 'sent'])->name('password.sent');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::get('verify-email/{token}', [RegisterController::class, 'verify'])->name('verify-email');
Route::post('verify-email/resend', [RegisterController::class, 'resend'])->name('verify-email.resend');

Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('products-barcode/search', [ProductController::class, 'barcodeSearch'])
    ->middleware('role:sales,admin')
    ->name('products.barcode-search');

Route::middleware('role:sales')->group(function () {
    Route::resource('sales', SaleController::class)->only(['index', 'create', 'store', 'show']);
});

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('products-export/download', [ProductController::class, 'export'])->name('products.export');

    Route::resource('users', UserController::class)->names('admin.users');

    Route::resource('suppliers', SupplierController::class)->except(['show']);
    Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('stock-takes', StockTakeController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('stock-takes/{stockTake}/post', [StockTakeController::class, 'post'])->name('stock-takes.post');

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('inventory-value', [ReportController::class, 'inventoryValue'])->name('inventory-value');
        Route::get('profit', [ReportController::class, 'profit'])->name('profit');
        Route::get('low-stock', [ReportController::class, 'lowStock'])->name('low-stock');
        Route::get('stock-movements', [ReportController::class, 'stockMovements'])->name('stock-movements');
    });
});
