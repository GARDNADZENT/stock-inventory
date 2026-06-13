<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTakeRequest;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\StockTake;
use App\Services\InventoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StockTakeController extends Controller
{
    public function index(): View
    {
        return view('stock_takes.index', ['stockTakes' => StockTake::query()->latest()->paginate(15)]);
    }

    public function create(): View
    {
        return view('stock_takes.create');
    }

    public function store(StockTakeRequest $request): RedirectResponse
    {
        $stockTake = DB::transaction(function () use ($request) {
            $stockTake = StockTake::query()->create([
                'stock_take_date' => $request->stock_take_date,
                'notes' => $request->notes,
                'status' => 'draft',
            ]);

            foreach ($request->validated('items') as $item) {
                $product = Product::query()->where('barcode', $item['barcode'])->firstOrFail();
                $counted = (int) $item['counted_quantity'];

                $stockTake->items()->create([
                    'product_id' => $product->id,
                    'system_quantity' => $product->stock,
                    'counted_quantity' => $counted,
                    'variance' => $counted - $product->stock,
                ]);
            }

            return $stockTake;
        });

        return redirect()->route('stock-takes.show', $stockTake)->with('success', 'Stock take saved as draft.');
    }

    public function show(StockTake $stockTake): View
    {
        return view('stock_takes.show', ['stockTake' => $stockTake->load('items.product')]);
    }

    public function post(StockTake $stockTake, InventoryService $inventory): RedirectResponse
    {
        if ($stockTake->status === 'posted') {
            return back()->with('error', 'Stock take is already posted.');
        }

        DB::transaction(function () use ($stockTake, $inventory) {
            foreach ($stockTake->items()->with('product')->get() as $item) {
                $inventory->setStock($item->product, $item->counted_quantity, StockMovement::TYPE_STOCK_TAKE, $stockTake->id, StockTake::class, 'Stock take posted');
            }

            $stockTake->update(['status' => 'posted', 'posted_at' => now()]);
        });

        return redirect()->route('stock-takes.show', $stockTake)->with('success', 'Stock adjustments posted.');
    }
}
