<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class InventoryService
{
    public function increaseStock(Product $product, int $quantity, string $type, ?int $referenceId = null, ?string $referenceType = null, ?string $notes = null): Product
    {
        return DB::transaction(function () use ($product, $quantity, $type, $referenceId, $referenceType, $notes) {
            $product = Product::query()->lockForUpdate()->findOrFail($product->id);
            $before = $product->stock;
            $product->increment('stock', $quantity);
            $product->refresh();

            $this->recordMovement($product, $type, $quantity, $before, $product->stock, $referenceId, $referenceType, $notes);

            return $product;
        });
    }

    public function decreaseStock(Product $product, int $quantity, string $type, ?int $referenceId = null, ?string $referenceType = null, ?string $notes = null): Product
    {
        return DB::transaction(function () use ($product, $quantity, $type, $referenceId, $referenceType, $notes) {
            $product = Product::query()->lockForUpdate()->findOrFail($product->id);

            if ($product->stock < $quantity) {
                throw new RuntimeException("Insufficient stock for {$product->product_name}.");
            }

            $before = $product->stock;
            $product->decrement('stock', $quantity);
            $product->refresh();

            $this->recordMovement($product, $type, -$quantity, $before, $product->stock, $referenceId, $referenceType, $notes);

            return $product;
        });
    }

    public function setStock(Product $product, int $newQuantity, string $type = StockMovement::TYPE_ADJUSTMENT, ?int $referenceId = null, ?string $referenceType = null, ?string $notes = null): Product
    {
        return DB::transaction(function () use ($product, $newQuantity, $type, $referenceId, $referenceType, $notes) {
            $product = Product::query()->lockForUpdate()->findOrFail($product->id);
            $before = $product->stock;
            $difference = $newQuantity - $before;
            $product->update(['stock' => $newQuantity]);
            $product->refresh();

            $this->recordMovement($product, $type, $difference, $before, $product->stock, $referenceId, $referenceType, $notes);

            return $product;
        });
    }

    private function recordMovement(Product $product, string $type, int $quantityChange, int $before, int $after, ?int $referenceId, ?string $referenceType, ?string $notes): void
    {
        StockMovement::query()->create([
            'product_id' => $product->id,
            'movement_type' => $type,
            'quantity_change' => $quantityChange,
            'stock_before' => $before,
            'stock_after' => $after,
            'reference_id' => $referenceId,
            'reference_type' => $referenceType,
            'notes' => $notes,
        ]);
    }
}
