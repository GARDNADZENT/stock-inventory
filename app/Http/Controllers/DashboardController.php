<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'totalProducts' => Product::query()->count(),
            'inventoryValue' => Product::query()->selectRaw('COALESCE(SUM(stock * buying_price), 0) as value')->value('value'),
            'todaysSales' => Sale::query()->whereDate('sale_date', today())->sum('total_amount'),
            'todaysPurchases' => Purchase::query()->whereDate('purchase_date', today())->sum('total_amount'),
            'lowStockProducts' => Product::query()->lowStock()->count(),
            'outOfStockProducts' => Product::query()->outOfStock()->count(),
            'recentLowStock' => Product::query()->lowStock()->orderBy('stock')->limit(8)->get(),
        ]);
    }
}
