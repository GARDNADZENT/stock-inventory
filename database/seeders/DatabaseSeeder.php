<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::query()->create([
            'supplier_name' => 'Default Supplier',
            'phone' => '+254700000000',
            'email' => 'supplier@example.com',
            'address' => 'Nairobi',
        ]);

        Product::query()->insert([
            ['barcode' => '100000000001', 'product_name' => 'Milk 500ml', 'category' => 'Dairy', 'buying_price' => 45, 'selling_price' => 60, 'stock' => 24, 'reorder_level' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['barcode' => '100000000002', 'product_name' => 'Bread Loaf', 'category' => 'Bakery', 'buying_price' => 50, 'selling_price' => 65, 'stock' => 16, 'reorder_level' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['barcode' => '100000000003', 'product_name' => 'Cooking Oil 1L', 'category' => 'Grocery', 'buying_price' => 260, 'selling_price' => 320, 'stock' => 5, 'reorder_level' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
