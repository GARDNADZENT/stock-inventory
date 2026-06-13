<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTake extends Model
{
    use HasFactory;

    protected $fillable = ['stock_take_date', 'status', 'notes', 'posted_at'];

    protected function casts(): array
    {
        return ['stock_take_date' => 'date', 'posted_at' => 'datetime'];
    }

    public function items()
    {
        return $this->hasMany(StockTakeItem::class);
    }
}
