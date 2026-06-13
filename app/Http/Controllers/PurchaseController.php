<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Services\InventoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function index(): View
    {
        return view('purchases.index', ['purchases' => Purchase::with('supplier')->latest()->paginate(15)]);
    }

    public function create(): View
    {
        return view('purchases.create', ['suppliers' => Supplier::query()->orderBy('supplier_name')->get()]);
    }

    public function store(PurchaseRequest $request, InventoryService $inventory): RedirectResponse
    {
        $purchase = DB::transaction(function () use ($request, $inventory) {
            $purchase = Purchase::query()->create([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
                'notes' => $request->notes,
                'total_amount' => 0,
            ]);

            $total = 0;

            foreach ($request->validated('items') as $item) {
                $product = Product::query()->where('barcode', $item['barcode'])->firstOrFail();
                $lineTotal = $item['quantity'] * $item['buying_price'];
                $total += $lineTotal;

                $purchase->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'buying_price' => $item['buying_price'],
                    'line_total' => $lineTotal,
                ]);

                $inventory->increaseStock($product, $item['quantity'], StockMovement::TYPE_PURCHASE, $purchase->id, Purchase::class, 'Purchase received');
            }

            $purchase->update(['total_amount' => $total]);

            return $purchase;
        });

        return redirect()->route('purchases.show', $purchase)->with('success', 'Purchase recorded and stock increased.');
    }

    public function show(Purchase $purchase): View
    {
        return view('purchases.show', ['purchase' => $purchase->load('supplier', 'items.product')]);
    }
}
