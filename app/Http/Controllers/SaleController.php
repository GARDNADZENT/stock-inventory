<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Models\StockMovement;
use App\Services\InventoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        return view('sales.index', ['sales' => Sale::query()->latest()->paginate(15)]);
    }

    public function create(): View
    {
        return view('sales.create');
    }

    public function store(SaleRequest $request, InventoryService $inventory): RedirectResponse
    {
        $sale = DB::transaction(function () use ($request, $inventory) {
            $sale = Sale::query()->create([
                'sale_date' => $request->sale_date,
                'notes' => $request->notes,
                'total_amount' => 0,
                'total_profit' => 0,
            ]);

            $total = 0;
            $profit = 0;

            foreach ($request->validated('items') as $item) {
                $product = Product::query()->where('barcode', $item['barcode'])->firstOrFail();
                $lineTotal = $item['quantity'] * $item['selling_price'];
                $lineProfit = $item['quantity'] * ($item['selling_price'] - $product->buying_price);
                $total += $lineTotal;
                $profit += $lineProfit;

                $sale->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'buying_price' => $product->buying_price,
                    'selling_price' => $item['selling_price'],
                    'line_total' => $lineTotal,
                    'profit' => $lineProfit,
                ]);

                $inventory->decreaseStock($product, $item['quantity'], StockMovement::TYPE_SALE, $sale->id, Sale::class, 'Sale completed');
            }

            $sale->update(['total_amount' => $total, 'total_profit' => $profit]);

            return $sale;
        });

        return redirect()->route('sales.show', $sale)->with('success', 'Sale recorded and stock decreased.');
    }

    public function show(Sale $sale): View
    {
        return view('sales.show', ['sale' => $sale->load('items.product')]);
    }
}
