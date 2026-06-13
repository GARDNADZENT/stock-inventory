<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockTakeController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
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
