<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleItem;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function inventoryValue(): View
    {
        $products = Product::query()->orderBy('product_name')->get();
        $totalValue = $products->sum(fn ($product) => $product->stock * $product->buying_price);

        return view('reports.inventory_value', compact('products', 'totalValue'));
    }

    public function profit(Request $request): View
    {
        $items = SaleItem::query()
            ->with('product', 'sale')
            ->when($request->from, fn ($query, $from) => $query->whereHas('sale', fn ($sale) => $sale->whereDate('sale_date', '>=', $from)))
            ->when($request->to, fn ($query, $to) => $query->whereHas('sale', fn ($sale) => $sale->whereDate('sale_date', '<=', $to)))
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('reports.profit', ['items' => $items, 'totalProfit' => $items->sum('profit')]);
    }

    public function lowStock(): View
    {
        return view('reports.low_stock', ['products' => Product::query()->lowStock()->orWhere(fn ($query) => $query->outOfStock())->orderBy('stock')->get()]);
    }

    public function stockMovements(Request $request): View
    {
        $movements = StockMovement::query()
            ->with('product')
            ->when($request->movement_type, fn ($query, $type) => $query->where('movement_type', $type))
            ->latest()
            ->paginate(30)
            ->withQueryString();

        return view('reports.stock_movements', compact('movements'));
    }
}
