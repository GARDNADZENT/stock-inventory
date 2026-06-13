<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTakeItem extends Model
{
    use HasFactory;

    protected $fillable = ['stock_take_id', 'product_id', 'system_quantity', 'counted_quantity', 'variance'];

    protected function casts(): array
    {
        return ['system_quantity' => 'integer', 'counted_quantity' => 'integer', 'variance' => 'integer'];
    }

    public function stockTake()
    {
        return $this->belongsTo(StockTake::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
