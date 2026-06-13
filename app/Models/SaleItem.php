<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'product_id', 'quantity', 'buying_price', 'selling_price', 'line_total', 'profit'];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'buying_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'line_total' => 'decimal:2',
            'profit' => 'decimal:2',
        ];
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
