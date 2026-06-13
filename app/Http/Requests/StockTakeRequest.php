<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockTakeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stock_take_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.barcode' => ['required', 'exists:products,barcode'],
            'items.*.counted_quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
