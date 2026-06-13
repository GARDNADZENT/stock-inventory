<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?Product
    {
        if (empty($row['barcode']) || empty($row['product_name'])) {
            return null;
        }

        return Product::query()->updateOrCreate(
            ['barcode' => (string) $row['barcode']],
            [
                'product_name' => $row['product_name'],
                'category' => $row['category'] ?? null,
                'buying_price' => $row['buying_price'] ?? 0,
                'selling_price' => $row['selling_price'] ?? 0,
                'stock' => $row['stock'] ?? 0,
                'reorder_level' => $row['reorder_level'] ?? 0,
            ]
        );
    }
}
