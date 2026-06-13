<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::query()
            ->select('id', 'barcode', 'product_name', 'category', 'buying_price', 'selling_price', 'stock', 'reorder_level', 'created_at', 'updated_at')
            ->orderBy('product_name')
            ->get();
    }

    public function headings(): array
    {
        return ['id', 'barcode', 'product_name', 'category', 'buying_price', 'selling_price', 'stock', 'reorder_level', 'created_at', 'updated_at'];
    }
}
