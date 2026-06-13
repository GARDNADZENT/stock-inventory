<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'product_name',
        'category',
        'buying_price',
        'selling_price',
        'stock',
        'reorder_level',
    ];

    protected function casts(): array
    {
        return [
            'buying_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'stock' => 'integer',
            'reorder_level' => 'integer',
        ];
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'reorder_level')->where('stock', '>', 0);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('stock', '<=', 0);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
